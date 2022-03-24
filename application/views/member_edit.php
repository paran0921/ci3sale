<?php
    // var_dump($row);
    $no=$row->no;
    $tel1=trim(substr($row->tel,0,3));
    $tel2=trim(substr($row->tel,3,4));
    $tel3=trim(substr($row->tel,7,4));
    $tel=$tel1."-".$tel2."-".$tel3;
    $rank = (int)$row->rank===0 ? "직원":"관리자";
?> 
            <br>
            <div class="alert mycolor1" role="alert">사용자</div>

            <form action="" name="form1" method="post">
                <table class="table table-bordered table-sm mymargin5">
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">번호</td>
                        <td width="80%" align="left"><?php echo $no; ?></td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>이름</td>
                        <td width="80%" align="left">
                        <!--
                        <div class="form-inline"><input type="text" name="name" size="20" maxlength="20" value="<?php echo $row->name; ?>" class="form-control form-control-sm"></div>
                        -->
                        <div class="form-inline"><input type="text" name="name" size="20" value="<?php echo $row->name; ?>" class="form-control form-control-sm"></div>
                        <?php if(form_error("name")==TRUE) echo form_error("name"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>아이디</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><input type="text" name="uid" size="20" maxlength="20" value="<?php echo $row->uid; ?>" class="form-control form-control-sm"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>암호</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><input type="text" name="pwd" size="20" maxlength="20" value="<?php echo $row->pwd; ?>" class="form-control form-control-sm"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">전화</td>
                        <td width="80%" align="left">
                            <div class="form-inline">
                            <input type="text" name="tel1" size="3" maxlength="3" value="<?php echo $tel1; ?>" class="form-control form-control-sm">
                            -<input type="text" name="tel2" size="4" maxlength="4" value="<?php echo $tel2; ?>" class="form-control form-control-sm">
                            -<input type="text" name="tel3" size="4" maxlength="4" value="<?php echo $tel3; ?>" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">등급</td>
                        <td width="80%" align="left">
                            <div class="form-inline">
                            <input type="radio" name="rank" value="0" <? if((int)$row->rank===0) { echo "checked"; } ?> >&nbsp;직원&nbsp;&nbsp;
                            <input type="radio" name="rank" value="1" <? if((int)$row->rank===1) { echo "checked"; } ?> >&nbsp;관리자
                            </div>
                        </td>
                    </tr>
                </table>

                <div align="center">
                    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
