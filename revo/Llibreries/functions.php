<?php
    function setDate(){
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d h:i:s', time());
        return $date;
    }
    function uploadVideo(){
        $fileTmpPath = $_FILES['video']['tmp_name'];
        $fileName = $_FILES['video']['name'];
        $fileType = $_FILES['video']['type'];
        $uploadFileDir = './media/vid/';

        $fileName=hash('sha256',random_int(0,10000));
		$dest_path = $uploadFileDir . $fileName. ".mp4";
		move_uploaded_file($fileTmpPath, $dest_path);
        return $dest_path;
    }

    function error(){
        echo '
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Error with data</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn float-right login_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            <script type="text/javascript">
                $("#myModal").modal("show");
            </script>'
            ;
    }
    function errorPass(){
        echo ' <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <form action="./index.php" method="get">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
                                </div>
                                <div class="modal-body">
                                    <p>This request is no valid now!</p>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn float-right login_btn" value="Close">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <script type="text/javascript">
                $("#myModal").modal("show");
            </script>'
            ;
    }