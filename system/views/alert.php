<?php
if(isset($_GET['status']) || isset($status)){
    echo '<div style="padding: 10px;">';
    if($_GET['status']==1 || $status==1){
        echo '<div class="alert alert-success">
                                            <button class="close" data-dismiss="alert">×</button>
                                            <strong>Success!</strong> Update berhasil.
                                        </div>';
    }else{
        echo '<div class="alert alert-error">
                                            <button class="close" data-dismiss="alert">×</button>
                                            <strong>Error!</strong> Update gagal.
                                        </div>';
    }
    echo "</div>";
}
?>