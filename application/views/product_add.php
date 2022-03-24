
            <br>
            <div class="alert mycolor1" role="alert">제품</div>

            <form action="" name="form1" method="post" enctype="multipart/form-data" class="form-inline">
                <table class="table table-bordered table-sm mymargin5">
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>구분명</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <select id="gubun_no" class="form-control input-sm" name="gubun_no">
                                <option value="">선택하세요.</option> 
                                <?php 
                                    $gubun_no=set_value("gubun_no");
                                    foreach ($list as $row) :
                                        if($row->no == $gubun_no)
                                            echo "<option value='$row->no' selected>$row->name</option>";
                                        else 
                                            echo "<option value='$row->no'>$row->name</option>";
                                    endforeach  
                                ?>
                            </select>
                        </div>
                        <?php if(form_error("gubun_no")==TRUE) echo form_error("gubun_no"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>제품명</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="name" value="<?php echo set_value("name"); ?>" class="form-control form-control-sm">
                        </div>
                        <?php if(form_error("name")==TRUE) echo form_error("name"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>단가</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="price" value="<?php echo set_value("price"); ?>" class="form-control form-control-sm">
                        </div>
                        <?php if(form_error("price")==TRUE) echo form_error("price"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">재고</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="jaego" value="" class="form-control form-control-sm">
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">사진</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="file" name="pic" value="" class="form-control form-control-sm">
                        </div>
                        </td>
                    </tr>
                </table>

                <div align="center">
                    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
