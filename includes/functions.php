<?php

function getSize($fichero_size)
{
    if ($fichero_size > (1000 * 1000 * 1000)) {
        $size = $fichero_size / (1000 * 1000 * 1000);
        $fichero_size = round($size, 2) . "GB";
    } else if ($fichero_size > (1000 * 1000)) {
        $size = $fichero_size / (1000 * 1000);
        $fichero_size = round($size, 2) . "MB";
    } else if ($fichero_size > 1000) {
        $size = $fichero_size / 1000;
        $fichero_size = round($size, 2) . "KB";
    } else if ($fichero_size > 0) {
        $fichero_size = $fichero_size . "B";
    }

    return $fichero_size;
}

function getIcon($ftype, $width, $height)
{

    //comprobar si es imagen
    if (strtolower($ftype[1]) == "png" || strtolower($ftype[1]) == "jpeg" || strtolower($ftype[1]) == "gif" || strtolower($ftype[1]) == "jpg" || strtolower($ftype[1]) == "bmp") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
  <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
</svg>';
    } //compruebo si es audio
    elseif (strtolower($ftype[1]) == "mp3" || strtolower($ftype[1]) == "wav" || strtolower($ftype[1]) == "wma" || strtolower($ftype[1]) == "ogg" || strtolower($ftype[1]) == "mp4") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-music" viewBox="0 0 16 16">
  <path d="M10.304 3.13a1 1 0 0 1 1.196.98v1.8l-2.5.5v5.09c0 .495-.301.883-.662 1.123C7.974 12.866 7.499 13 7 13c-.5 0-.974-.134-1.338-.377-.36-.24-.662-.628-.662-1.123s.301-.883.662-1.123C6.026 10.134 6.501 10 7 10c.356 0 .7.068 1 .196V4.41a1 1 0 0 1 .804-.98l1.5-.3z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>';
    } //comrpuebo si son zip, rar u otros
    elseif (strtolower($ftype[1]) == "zip" || strtolower($ftype[1]) == "rar" || strtolower($ftype[1]) == "tgz" || strtolower($ftype[1]) == "tar") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-zip" viewBox="0 0 16 16">
  <path d="M6.5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V7.5zm2 0h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243V7.5z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm5.5-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9v1H8v1h1v1H8v1h1v1H7.5V5h-1V4h1V3h-1V2h1V1z"/>
</svg>';
    } //compruebo si es un archivo de codigo
    elseif (strtolower($ftype[1]) == "php" || strtolower($ftype[1]) == "php3" || strtolower($ftype[1]) == "html" || strtolower($ftype[1]) == "css" || strtolower($ftype[1]) == "py" || strtolower($ftype[1]) == "java" || strtolower($ftype[1]) == "js" || strtolower($ftype[1]) == "sql") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-code" viewBox="0 0 16 16">
  <path d="M6.646 5.646a.5.5 0 1 1 .708.708L5.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zm2.708 0a.5.5 0 1 0-.708.708L10.293 8 8.646 9.646a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
</svg>';
    } //compruebo si es el archivo es de tipo pdf
    elseif (strtolower($ftype[1]) == "pdf") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
  <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
</svg>';
    } //compruebo si es el archivo es excel
    elseif (strtolower($ftype[1]) == "xlsx") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-excel" viewBox="0 0 16 16">
  <path d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>';
    } //compruebo si es el archivo es de powerpoint
    elseif (strtolower($ftype[1]) == "pptx") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-ppt" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
  <path d="M6 5a1 1 0 0 1 1-1h1.188a2.75 2.75 0 0 1 0 5.5H7v2a.5.5 0 0 1-1 0V5zm1 3.5h1.188a1.75 1.75 0 1 0 0-3.5H7v3.5z"/>
</svg>';
    } //compruebo si es el archivo es de word
    elseif (strtolower($ftype[1]) == "docx") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-word" viewBox="0 0 16 16">
  <path d="M4.879 4.515a.5.5 0 0 1 .606.364l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 0 1 .364-.606z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>';
    } //compruebo si es el archivo es de texto
    elseif (strtolower($ftype[1]) == "txt") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
  <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
</svg>';
    } //compruebo si es el archivo es de video
    elseif (strtolower($ftype[1]) == "avi" || strtolower($ftype[1]) == "asf" || strtolower($ftype[1]) == "dvd"
        || strtolower($ftype[1]) == "m1v" || strtolower($ftype[1]) == "movie" || strtolower($ftype[1]) == "mpeg"
        || strtolower($ftype[1]) == "wn" || strtolower($ftype[1]) == "wmv") {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file-play" viewBox="0 0 16 16">
  <path d="M6 10.117V5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>';
    } else {
        $icono = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" fill="currentColor" class="bi bi-file" viewBox="0 0 16 16">
                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                        </svg>';
    }

    return $icono;
}

function getPass($id_user)
{
    require 'conector_BD.php';
    $conn->set_charset('uft8');

    $result = $conn->query('SELECT * FROM usuarios WHERE userId = ' . $id_user);
    $row = $result->fetch_assoc();

    return $row['password'];
}

function consultaficheros($code)
{
    require_once 'conector_BD.php';
    $conn->set_charset('uft8');

    try {
        $consulta = mysqli_query($conn, "SELECT * FROM files");

        if (!empty($consulta)) {
            while ($row = mysqli_fetch_assoc($consulta))
                $files[] = $row;
        }

        if (!empty($files)) {
            foreach ($files as $value) {
                if (password_verify($value['code'], $code)) {
                    return $value;
                }
            }
        }

    } catch (PDOException $ex) {
        header('Location: ../index.php?log=error2');
    }
    exit();
}