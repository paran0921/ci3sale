            <br>
            <div class="alert mycolor1" role="alert">제품</div>
            
            <script>
                function find_text() {
                    if(!form1.text1.value)
                        form1.action="/product/lists";
                    else
                        form1.action="/product/lists/text1/" + form1.text1.value;
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
                        <a class="btn btn-sm mycolor1" href="/product/add<?php echo $tmp; ?>">추가</a>
                        <a href="/product/jaego<?php echo $tmp; ?>" class="btn btn-sm mycolor1">재고계산</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5">
                <tr class="mycolor2">
                    <td width="10%">번호</td>
                    <td width="20%">구분명</td>
                    <td width="30%">제품명</td>
                    <td width="20%">단가</td>
                    <td width="20%">재고</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
        $no=$row->no;
?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row->gubun_name; ?></td>
                        <td align="left"><a href="/product/view/no/<?php echo $no ?><?php echo $tmp; ?>"><?php echo $row->name ?></a></td>
                        <td align="right"><?php echo number_format($row->price); ?></td>
                        <td align="right"><?php echo number_format($row->jaego); ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
