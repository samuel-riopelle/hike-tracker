<?php
/**
 * Description : Logs adventure with data from the new.php form into the adventures folder
 * 
 * @author Samuel Riopelle
 */
class Adventure_Logger{
    /**
     * Form submission data
     * @var array
     */
    private $adventure;

    /** 
     * Constructor
     */
    public function __construct() {
        $this->adventure = array();
    }

    /**
     * Logs the current adventure in folder
     */
    public function show_gallery() {
        $array = array();
        $link = '';
        $adventures_folder = scandir( "adventures/" );

        $year_folders = array_diff( $adventures_folder, array( '.', '..' ) );

        foreach ( $year_folders as $key => $years ) {
            $files = scandir( "adventures/" . $years . "/" );
            $files = array_diff( $files, array( '.', '..' ) );

            foreach ( $files as $key => $json_file ) {
                $path = "adventures/" . $years . "/" . $json_file;
                array_push($array, $path);                     
            }
        }
        return $array;
    }

    /**
     * Sets form data in array then encode and save as a .json file
     */
    public static function set_data() {
        // Fill form data in an array
        $data_array = array(
            "title"    => $_POST["title"],
            "location" => $_POST["location"],
            "date"     => $_POST["date"],
            "notes"    => $_POST["notes"],
        );
        
        $data_json = json_encode( $data_array, JSON_PRETTY_PRINT );

        $filename = str_replace( " ", "", strtolower( $data_array["title"] ) );

        $date = explode( "-", $data_array["date"] );
        $year = $date[0];

        $path = "adventures/" . $year . "/";

        file_put_contents( $path . $filename . ".json", $data_json );
    }
}