            <br>
            <div class="alert mycolor1" role="alert">월간 제품별 매출현황</div>
            
            <script>
                function find_text() {
                    form1.action="/gigan/lists/text1/" + form1.text1.value + "/page";
                    form1.submit();
                }
                
                $(function() {
                    $('#text1').datetimepicker({
                        locale: 'ko',
                        format: 'YYYY',
                        defaultDate: moment()
                    });

                    $('#text1').on("dp.change", function (e) {
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
                                    <span class="input-group-text">년도</span>
                                </div>
                                <input type="text" name="text1" value="<?php echo $text1; ?>" class="form-control" size="9" onkeydown="if (event.keyCode == 13) { find_text(); }">
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
                    <td width="5%">1월</td>
                    <td width="5%">2월</td>
                    <td width="5%">3월</td>
                    <td width="5%">4월</td>
                    <td width="5%">5월</td>
                    <td width="5%">6월</td>
                    <td width="5%">7월</td>
                    <td width="5%">8월</td>
                    <td width="5%">9월</td>
                    <td width="5%">10월</td>
                    <td width="5%">11월</td>
                    <td width="5%">12월</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
?>
                    <tr>
                        <td align="left"><?php echo $row->product_name ?></td>
                        <td align="right"><?php echo $row->s1 == 0 ? "" : number_format($row->s1); ?></td>
                        <td align="right"><?php echo $row->s2 == 0 ? "" : number_format($row->s2); ?></td>
                        <td align="right"><?php echo $row->s3 == 0 ? "" : number_format($row->s3); ?></td>
                        <td align="right"><?php echo $row->s4 == 0 ? "" : number_format($row->s4); ?></td>
                        <td align="right"><?php echo $row->s5 == 0 ? "" : number_format($row->s5); ?></td>
                        <td align="right"><?php echo $row->s6 == 0 ? "" : number_format($row->s6); ?></td>
                        <td align="right"><?php echo $row->s7 == 0 ? "" : number_format($row->s7); ?></td>
                        <td align="right"><?php echo $row->s8 == 0 ? "" : number_format($row->s8); ?></td>
                        <td align="right"><?php echo $row->s9 == 0 ? "" : number_format($row->s9); ?></td>
                        <td align="right"><?php echo $row->s10 == 0 ? "" : number_format($row->s10); ?></td>
                        <td align="right"><?php echo $row->s11 == 0 ? "" : number_format($row->s11); ?></td>
                        <td align="right"><?php echo $row->s12 == 0 ? "" : number_format($row->s12); ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
