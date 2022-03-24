            <br>
            <div class="alert mycolor1" role="alert">제품선택</div>
            
            <script>
                function find_text() {
                    if(!form1.text1.value)
                        form1.action="/product/lists";
                    else
                        form1.action="/product/lists/text1/" + form1.text1.value;
                    form1.submit();
                }

                function SendProduct(no, name, price)
                {
                    opener.form1.product_no.value = no;
                    opener.form1.product_name.value = name;
                    opener.form1.price.value = price;
                    opener.form1.prices.value = Number(price) * Number(opener.form1.numo.value);
                    self.close();
                }
            </script>
<?php
    // 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
    $tmp = $text1 ? "/text1/$text1/page/$page":"/page/$page";
?>
            <form action="" name="form1" method="post">
                <div class="row">
                    <div class="col-6" align="left">
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
                    <div class="col-6" align="right">
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
                        <td align="left"><a href="void();" onclick="SendProduct('<?php echo $row->no;?>', '<?php echo $row->name; ?>', '<?php echo $row->price; ?>');"><?php echo $row->name ?></a></td>
                        <td align="right"><?php echo number_format($row->price); ?></td>
                        <td align="right"><?php echo number_format($row->jaego); ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
