
<?php

    require_once('./admin/layouts/config.php');
    require_once('./admin/layouts/function.php');

    //-----------------------------------------------------------------------
    /* $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);

    $conditions = ['url' => $page];
    $url_data1 = single_row("convert_data", $conditions, $conn);
    $url_data2 = single_row("compress_data", $conditions, $conn);

    if(!empty($url_data1['id']) && $url_data1['id'] == '31') {

        header("Location: ".base_url."convert_m.php?id=".$url_data1['id']);
        exit;
    }
    if(!empty($url_data1['id']) && $url_data1['id'] != '31') {

        header("Location: ".base_url."convert.php?id=".$url_data1['id']);
        exit;
    }
    if(!empty($url_data2['id'])) {

        header("Location: ".base_url."compress.php?id=".$url_data2['id']);
        exit;
    } */
    //-----------------------------------------------------------------------

    //-----------------------------------------------------------------------
    $conditions = ['status' => 1];
    $return_data = single_row("setting", $conditions, $conn);
    if(empty($return_data['id'])) {

        echo $message = "<div class='alert alert-danger'>Something Went Wrong...</div>";
        $display = "none";
        exit;
    }
    else {

        $api_secret = $return_data['api_secret'];
        define('api_secret', $api_secret);
    }
    //-----------------------------------------------------------------------

    function make_text_file($path, $content)
    {
        $fp = fopen($path, "wb");
        fwrite($fp, $content);
        fclose($fp);
        return true;
        exit;
    }

    function api_secret_update($secret, $conn)
    {
        $conditions = ['`api_secret`' => $secret];
        $return_data = single_row("`setting`", $conditions, $conn);
        
        if(!empty($return_data['id'])) 
        {
            $total_used = $return_data['total_used'];
            if($total_used < 250)
            {
                $total_used = $total_used + 1;
                $data = ['total_used' => $total_used];
                $conditions = ['api_secret' => $secret];
                update_data("setting", $data, $conditions, $conn);
                return true;
            }
            else if($total_used == 250)
            {
                $data = ['status' => 0];
                $conditions = ['api_secret' => $secret];
                update_data("setting", $data, $conditions, $conn);
                return true;
            }
            else {
                return false;
            }
        }
        exit;
    }

    function function_data_insert($response, $id, $conn)
    {
      $res_data = [];
      foreach($response['Files'] as $key => $val) {

          $res_data['file_url'][] = $val['Url'];
          $data = [
              'received_data_id' => $id,
              'output_data' => $val['Url'],
          ];
          $res_data['last_id'][] = insert("send_data", $data, $conn);
      }
      return $res_data;
      exit;
    }

    function convert_api_file($from, $to, $id, $data, $name, $conn)
    {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v2.convertapi.com/convert/'.$from.'/to/'.$to.'?Secret='.api_secret.'&StoreFile=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "Parameters": [
          {
            "Name": "File",
            "FileValue": {
              "Name": "'.$name.'",
              "Data": "'.$data.'"
            }
          },
          {
            "Name": "StoreFile",
            "Value": true
          }
        ]
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      // echo $response;

      /* $response = '{
          "ConversionCost": 1,
          "Files": [
              {
                  "FileName": "file_example_XLSX_10-2.png",
                  "FileExt": "png",
                  "FileSize": 65101,
                  "FileId": "zsnua0lpfvfnhbup08cgnzj6s0ez8oig",
                  "Url": "https://v2.convertapi.com/d/zsnua0lpfvfnhbup08cgnzj6s0ez8oig/file_example_XLSX_10-2.png"
              },
              {
                  "FileName": "file_example_XLSX_10-3.png",
                  "FileExt": "png",
                  "FileSize": 47517,
                  "FileId": "vp3lcpavl779i6cdxyesxf2dqdfwvaeu",
                  "Url": "https://v2.convertapi.com/d/vp3lcpavl779i6cdxyesxf2dqdfwvaeu/file_example_XLSX_10-3.png"
              },
              {
                  "FileName": "file_example_XLSX_10-8.png",
                  "FileExt": "png",
                  "FileSize": 21494,
                  "FileId": "jg4h1duapwmyet344sgxkntz8uultc0g",
                  "Url": "https://v2.convertapi.com/d/jg4h1duapwmyet344sgxkntz8uultc0g/file_example_XLSX_10-8.png"
              }
          ]
      }'; */

      $response = json_decode($response, true);
      if(empty($response['ConversionCost'])) {
        echo "<pre>";
        print_r($response);
        die;
      }
      else {
        api_secret_update(api_secret, $conn);
        $res_data = function_data_insert($response, $id, $conn);
        return $res_data;
        exit;
      }
    }

    function convert_api_url($from, $to, $id, $data, $name, $conn)
    {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v2.convertapi.com/convert/'.$from.'/to/'.$to.'?Secret='.api_secret.'&Url='.$data.'&StoreFile=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "Parameters": [
              {
                  "Name": "Url",
                  "Value": "'.$data.'"
              },
              {
                  "Name": "StoreFile",
                  "Value": true
              }
          ]
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      // echo $response;

      /* $response = '{
          "ConversionCost": 1,
          "Files": [
              {
                  "FileName": "file_example_XLSX_10-2.png",
                  "FileExt": "png",
                  "FileSize": 65101,
                  "FileId": "zsnua0lpfvfnhbup08cgnzj6s0ez8oig",
                  "Url": "https://v2.convertapi.com/d/zsnua0lpfvfnhbup08cgnzj6s0ez8oig/file_example_XLSX_10-2.png"
              },
              {
                  "FileName": "file_example_XLSX_10-3.png",
                  "FileExt": "png",
                  "FileSize": 47517,
                  "FileId": "vp3lcpavl779i6cdxyesxf2dqdfwvaeu",
                  "Url": "https://v2.convertapi.com/d/vp3lcpavl779i6cdxyesxf2dqdfwvaeu/file_example_XLSX_10-3.png"
              }
          ]
      }'; */

      $response = json_decode($response, true);
      if(empty($response['ConversionCost'])) {
        echo "<pre>";
        print_r($response);
        die;
      }
      else {
        api_secret_update(api_secret, $conn);
        $res_data = function_data_insert($response, $id, $conn);
        return $res_data;
        exit;
      }
    }

    function compress($source, $destination, $quality) 
    {
      $info = getimagesize($source);
      if ($info['mime'] == 'image/jpeg') 
          $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/gif') 
          $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png') 
          $image = imagecreatefrompng($source);

      imagejpeg($image, $destination, $quality);
      return $destination;
    }

    function zip($pathdir, $zipcreated, $id, $conn)
    {
      $zip = new ZipArchive();
      $zip->open( $zipcreated, ZipArchive::CREATE );

      $files = $pathdir;
      foreach ( $files as $file ) {
        $name_and_ext = basename( $file );
        $zip->addFile( $file, "{$name_and_ext}" ); 
      }
      $zip->close();

      // ob_clean();
      // ob_end_flush();

      // header( "Content-Type: application/zip" );
      // header( "Content-disposition: attachment; filename={$zipcreated}" );
      // readfile( $zipcreated );

      $res_data = [];
      if(file_exists($zipcreated) == true) {
        $data = [
            'received_data_id' => $id,
            'output_data' => $zipcreated,
        ];
        $res_data['file_url'][] = base_url.$zipcreated;
        $res_data['last_id'][] = insert("send_data", $data, $conn);
      }
      else {
        $response = [
          'status' => false,
          'message' => 'Zip file not created.',
          'file' => $zipcreated,
        ];
        echo "<pre>";
        print_r($response);
        die;
      }
      return $res_data;
      exit;
    }

    function RemoveEmptySubFolders($path)
    {
      $empty=true;
      foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
      {
        if (is_dir($file))
        {
            if (!RemoveEmptySubFolders($file)) $empty=false;
        }
        else
        {
            $empty=false;
        }
      }
      if ($empty) rmdir($path);
      return $empty;
    }

    function convert_to_pdf_api($from, $to, $id, $data, $conn)
    {
      $arrary = [
        "Parameters" => [
                [
                    "Name" => "Files",
                    "FileValues" => $data
                ],
                [
                    "Name" => "StoreFile",
                    "Value" => true
                ]
            ]
        ];
    
      // echo "<pre>";
      // print_r($arrary);
      // echo json_encode($arrary);
      // die;

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v2.convertapi.com/convert/'.$from.'/to/'.$to.'?Secret='.api_secret.'&StoreFile=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($arrary),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      // echo $response;

      /* $response = '{
          "ConversionCost": 1,
          "Files": [
              {
                  "FileName": "file_example_GIF_500kB.pdf",
                  "FileExt": "pdf",
                  "FileSize": 1020216,
                  "FileId": "3e8a4tjf3j9oznx7ga5f45rs1xv2h9m4",
                  "Url": "https://v2.convertapi.com/d/3e8a4tjf3j9oznx7ga5f45rs1xv2h9m4/file_example_GIF_500kB.pdf"
              }
          ]
      }'; */

      $response = json_decode($response, true);
      if(empty($response['ConversionCost'])) {
        echo "<pre>";
        print_r($response);
        die;
      }
      else {
        api_secret_update(api_secret, $conn);
        $res_data = function_data_insert($response, $id, $conn);
        return $res_data;
        exit;
      }
    }

    function compress_pdf_api($id, $data, $name, $conn) 
    {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v2.convertapi.com/convert/pdf/to/compress?Secret='.api_secret.'&StoreFile=true&Presets=web',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "Parameters": [
              {
                  "Name": "File",
                  "FileValue": {
                    "Name": "'.$name.'",
                    "Data": "'.$data.'"
                  }
              },
              {
                  "Name": "StoreFile",
                  "Value": true
              }
          ]
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      // echo $response;

      /* $response = '{
        "ConversionCost": 1,
        "Files": [
            {
                "FileName": "Brand-Report.pdf",
                "FileExt": "pdf",
                "FileSize": 15909,
                "FileId": "28qloth2f2x6rlrm1tefryo7i9x191vf",
                "Url": "https://v2.convertapi.com/d/28qloth2f2x6rlrm1tefryo7i9x191vf/Brand-Report.pdf"
            }
        ]
      }'; */

      $response = json_decode($response, true);
      if(empty($response['ConversionCost'])) {
        echo "<pre>";
        print_r($response);
        die;
      }
      else {
        api_secret_update(api_secret, $conn);
        $res_data = function_data_insert($response, $id, $conn);
        return $res_data;
        exit;
      }
    }

?>
