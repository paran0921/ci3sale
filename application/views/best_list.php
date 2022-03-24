            <br>
            <div class="alert mycolor1" role="alert">BEST 제품</div>
            
            <script>
                function find_text() {
                    form1.action="/gigan/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/page";
                    form1.submit();
                }
                
                $(function() {
                    $('#text1').datetimepicker({
                        locale: 'ko',
                        format: 'YYYY-MM-DD',
                        defaultDate: moment()
                    });

                    $('#text2').datetimepicker({
                        locale: 'ko',
                        format: 'YYYY-MM-DD',
                        defaultDate: moment()
                    });

                    $('#text1').on("dp.change", function (e) {
                        find_text();
                    });

                    $('#text2').on("dp.change", function (e) {
                        find_text();
                    });
                });
            </script>

            <form action="" name="form1" method="post">
                <div class="row">
                    <div class="col-12" align="left">
                        <div class="form-inline">
                            <div class="input-group input-group-sm table-sm date" id="text1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">날짜</span>
                                </div>
                                <input type="text" name="text1" value="<?php echo $text1; ?>" class="form-control" size="9" onkeydown="if (event.keyCode == 13) { find_text(); }">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                                    </div>
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <div class="input-group input-group-sm table-sm date" id="text2">
                                <input type="text" name="text2" value="<?php echo $text2; ?>" class="form-control" size="9" onkeydown="if (event.keyCode == 13) { find_text(); }">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5">
                <tr class="mycolor2">
                    <td width="50%">제품명</td>
                    <td width="10%">총 판매수량</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
?>
                    <tr>
                        <td align="left"><?php echo $row->product_name ?></td>
                        <td align="right"><?php echo number_format($row->cnumo); ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
