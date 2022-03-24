            <br>
            <div class="alert mycolor1" role="alert">사용자</div>
            
            <script>
                function find_text() {
                    if(!form1.text1.value)
                        form1.action="/member/lists";
                    else
                        form1.action="/member/lists/text1/" + form1.text1.value;
                    form1.submit();
                }
            </script>
<?php
    // 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
    $tmp = $text1 ? "/text1/$text1/page/$page":"/page/$page";
?>
            <form action="" name="form1" method="post">
                <div class="row">
                    <div class="col-3" align="left">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">이름</span>
                            </div>
                            <input type="text" name="text1" value="<?php echo $text1; ?>" class="form-control" onkeydown="if (event.keyCode == 13) { find_text(); }">
                            <span class="input-group-append">
                                <button class="btn mycolor1" type="button" onclick="find_text();">검색</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-9" align="right">
                        <a class="btn btn-sm mycolor1" href="/member/add<?php echo $tmp; ?>">추가</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5">
                <tr class="mycolor2">
                    <td width="10%">번호</td>
                    <td width="20%">이름</td>
                    <td width="20%">전화</td>
                    <td width="20%">아이디</td>
                    <td width="20%">암호</td>
                    <td width="10%">등급</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
        $no=$row->no;
        $tel1=trim(substr($row->tel,0,3));
        $tel2=trim(substr($row->tel,3,4));
        $tel3=trim(substr($row->tel,7,4));
        $tel=$tel1."-".$tel2."-".$tel3;
        $rank = (int)$row->rank===0 ? "직원":"관리자";
?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><a href="/member/view/no/<?php echo $no ?><?php echo $tmp; ?>"><?php echo $row->name ?></a></td>
                        <td><?php echo $tel ?></td>
                        <td><?php echo $row->uid ?></td>
                        <td><?php echo $row->pwd ?></td>
                        <td><?php echo $rank ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
