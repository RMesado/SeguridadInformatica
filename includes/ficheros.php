<?php
include(dirname(__FILE__) . "/conector_BD.php");

$id = $_SESSION['u_id'];

$sql_ficheros = 'SELECT * FROM `files` WHERE `user_id` =' . $id;
$results = mysqli_query($conn, $sql_ficheros);

if (!empty($results)) {
    while ($row = mysqli_fetch_assoc($results)) {
        $files[] = $row;
    }
}

$directorio = "files/" . $id;
?>

<ul>
    <li>
        <h3>Listado de archivos</h3>
    </li>
    <li class="form-upload">
        <form method="post" action="/includes/upload.php" enctype='multipart/form-data' class="md-form">
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input id="fichero" type="file" class="custom-file-input" name="files[]" multiple/>
                    <label id="nfichero" class="custom-file-label" for="fichero">Ningún archivo seleccionado</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit" name="upload-files">Subir</button>
                </div>
            </div>
        </form>
    </li>
</ul>
<div class="table-responsive-sm">
    <table class="table table-dark">
        <thead>
        <tr>
            <th>Archivo</th>
            <th>Tamaño</th>
            <th>Fecha</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($files)) {
            foreach ($files as $columna_files => $value) {

                $ftype = explode(".", $value['filename']);
                $url = $directorio . $value['filename'];

                $code_hasheado = password_hash($value['code'], PASSWORD_BCRYPT);

                $icono = getIcon($ftype, 18, 18);
                ?>
                <tr>
                    <td>
                        <?php echo $icono; ?>
                        <?php echo $value['filename']; ?>
                    </td>
                    <td>
                        <?php
                        $file_size = getSize($value['filesize']);
                        echo $file_size;
                        ?>
                    </td>
                    <td>
                        <?php echo $value['created_at']; ?>
                    </td>
                    <td>
                        <a title="Compartir"
                           href="javascript:getlink('<?php echo $_SERVER['HTTP_HOST'] . '/index.php?share=' . $code_hasheado; ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-share" viewBox="0 0 16 16">
                                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a title="Descargar"
                           href="download.php?code=<?php echo $code_hasheado; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a class="delete" title="Eliminar" href="includes/delete_file.php?id=<?php echo $value['id']; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>


