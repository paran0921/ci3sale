<?php
    // var_dump($row);
    $no=$row->no;
    $tel1=trim(substr($row->tel,0,3));
    $tel2=trim(substr($row->tel,3,4));
    $tel3=trim(substr($row->tel,7,4));
    $tel=$tel1."-".$tel2."-".$tel3;
    $rank = (int)$row->rank===0 ? "직원":"관리자";

    // 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
    $tmp = $text1 ? "/no/$no/text1/$text1/page/$page":"/no/$no/page/$page";
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
                        <div class="form-inline"><?php echo $row->name; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>아이디</td>
                        <td width="80%" align="left">
                        <div class="form-inline"><?php echo $row->uid; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>암호</td>
                        <td width="80%" align="left">
                            <div class="form-inline"><?php echo $row->pwd; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">전화</td>
                        <td width="80%" align="left">
                            <div class="form-inline"><?php echo $tel; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">등급</td>
                        <td width="80%" align="left">
                            <div class="form-inline"><?php echo $rank; ?></div>
                        </td>
                    </tr>
                </table>

                <div align="center">
                <a href="/member/edit/<?php echo $tmp; ?>" class="btn btn-sm mycolor1">수정</a>&nbsp;
    <a href="/member/del/<?php echo $tmp; ?>" class="btn btn-sm mycolor1" onclick="return confirm('삭제할까요?');">삭제</a>&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
