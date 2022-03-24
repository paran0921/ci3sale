<?php
    // var_dump($row);
    $no=$row->no;
?> 
            <br>
            <div class="alert mycolor1" role="alert">구분</div>

            <form action="" name="form1" method="post">
                <table class="table table-bordered table-sm mymargin5">
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">번호</td>
                        <td width="80%" align="left"><?php echo $no; ?></td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>구분명</td>
                        <td width="80%" align="left">
                        <!--
                        <div class="form-inline"><input type="text" name="name" size="20" maxlength="20" value="<?php echo $row->name; ?>" class="form-control form-control-sm"></div>
                        -->
                        <div class="form-inline"><input type="text" name="name" size="20" value="<?php echo $row->name; ?>" class="form-control form-control-sm"></div>
                        <?php if(form_error("name")==TRUE) echo form_error("name"); ?>
                        </td>
                    </tr>
                </table>

                <div align="center">
                    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
