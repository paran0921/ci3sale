<?php
// var_dump($row);
$no=$row->no;

// 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
$tmp = $text1 ? "/no/$no/text1/$text1/page/$page":"/no/$no/page/$page";
?>
            <br>
            <div class="alert mycolor1" role="alert">제품</div>

            <form action="" name="form1" method="post">
                <table class="table table-bordered table-sm mymargin5">
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">번호</td>
                        <td width="80%" align="left"><?php echo $no; ?></td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>구분명</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><?php echo $row->gubun_name; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>제품명</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><?php echo $row->name; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>단가</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><?php echo $row->price; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">재고</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><?php echo $row->jaego; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">사진</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                            <b>파일이름</b> : <?php echo $row->pic; ?> <br>
                        </div>
                        <?php
                            if ($row->pic)
                                echo "<img src='/product_img/$row->pic' width='200' class='img-fluid img-thumbnail'>";
                            else
                                echo "<img src='' width='200' class='img-fluid img-thumbnail'>";
                        ?>
                        </td>
                    </tr>
                </table>

                <div align="center">
                    <a href="/product/edit/<?php echo $tmp; ?>" class="btn btn-sm mycolor1">수정</a>&nbsp;
                    <a href="/product/del/<?php echo $tmp; ?>" class="btn btn-sm mycolor1" onclick="return confirm('삭제할까요?');">삭제</a>&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
