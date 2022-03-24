            <br>
            <div class="alert mycolor1" role="alert">기간별 매출입현황</div>
            
            <script>
                function find_text() {
                    form1.action="/gigan/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/page";
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

                // 엑셀 저장
                function make_excel()
                {
                    form1.action = "/gigan/excel/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/page";
                    form1.submit();
                }
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
                            &nbsp;&nbsp;
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">제품명</span>
                                </div>
                                <div class="input-group-prepend">
                                    <select name="text3" class="form-control form-control-sm" onchange="find_text();">
                                        <option value="0">전체</option>
                                        <?php
                                            foreach ($list_product as $row) :
                                                if ($row->no == $text3)
                                                    echo "<option value='$row->no' selected>$row->name</option>";
                                                else 
                                                    echo "<option value='$row->no'>$row->name</option>";
                                            endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <input type="button" value="EXCEL" class="form-control btn btn-sm mycolor1" onclick=" if (confirm('엑셀파일로 저장할까요?')) make_excel();" >
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5">
                <tr class="mycolor2">
                    <td width="15%">날짜</td>
                    <td width="30%">제품명</td>
                    <td width="15%">단가</td>
                    <td width="10%">매입 수량</td>
                    <td width="10%">매출 수량</td>
                    <td width="15%">금액</td>
                    <td width="10%">비고</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
        $no=$row->no;
        $numi = $row->numi ? number_format($row->numi) : "";
        $numo = $row->numo ? number_format($row->numo) : "";
?>
                    <tr>
                        <td><?php echo $row->writeday; ?></td>
                        <td align="left"><a href="/gigan/view/no/<?php echo $no ?>"><?php echo $row->product_name ?></a></td>
                        <td align="right"><?php echo number_format($row->price); ?></td>
                        <td align="right" bgcolor="lightyello"><?php echo $numi; ?></td>
                        <td align="right" bgcolor="lightyello"><?php echo $numo; ?></td>
                        <td align="right"><?php echo number_format($row->prices); ?></td>
                        <td align="left"><?php echo $row->bigo; ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
