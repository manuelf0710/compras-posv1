<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index()
    {
       
    }
	
	public function createDirectory($root_path, $tipo_documento){
		$include_hour = true;
		$year = date("Y"); 
		$month = date("m"); 
		$day = date("d");		
		$hour = date("H"); 
		//The folder path for our file should be YYYY/MM/DD
		$directory_date = "/$year/$month/$day/$hour/".$tipo_documento;
		$full_directory = $root_path.$directory_date;
		if(!is_dir($full_directory)){
    		mkdir($full_directory, 755, true);
		}		
		
		return $directory_date;
	}
	
    public function store(Request $request)
    {
		//$directory_root = base_path().'\public\uploads\\'; /*directory root file uploads*/		
		$directory_root = public_path().'\uploads\\'; /*directory root file uploads*/		
		$datos = $request->all();
		//$tipo_documento = $datos['document_type'];
		$tipo_documento = $request->document_type;	
		
		$getDirectory = $this->createDirectory($directory_root, $tipo_documento);		
        $response = array();		
		
        $upload_dir = 'uploads/'.$getDirectory;
        $server_url = 'http://localhost:8000/';

        if($_FILES['file'])
        {
            $avatar_name = $_FILES["file"]["name"];
            $avatar_tmp_name = $_FILES["file"]["tmp_name"];
            $avatar_type = $_FILES["file"]["type"];
            $error = $_FILES["file"]["error"];
            
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);            
            
            if($error > 0){
                $response = array(
                    "status" => "error",
                    "error" => true,
                    "message" => "Error uploading the file!"
                );
            }else 
            {
                $aleatorio = rand(1000,1000000);
                $random_name = date("Ymd_His").'_'.$tipo_documento.'_'.$aleatorio.'.'.$ext;
                $upload_name = $upload_dir.strtolower($random_name);
                $file_name   = $random_name;            
                if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
                    $response = array(
                        "status" => "success",
                        "error" => false,
                        "message" => "File uploaded successfully",
                        "url" => $upload_name,
                        "full_url" => $server_url.$upload_name,
                        "file" => $file_name
                    );
                }else
                {
                    $response = array(
                        "status" => "error",
                        "error" => true,
                        "message" => "Error uploading the file!"
                    );
                }
            }
            
        }else{
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "No file was sent!"
            );
        }
        echo json_encode($response);
    }	
}