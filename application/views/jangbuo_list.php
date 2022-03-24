            <br>
            <div class="alert mycolor1" role="alert">매출장</div>
            
            <script>
                function find_text() {
                    form1.action="/jangbuo/lists/text1/" + form1.text1.value;
                    form1.submit();
                }
                
                $(function() {
                    $('#text1').datetimepicker({
                        locale: 'ko',
                        format: 'YYYY-MM-DD',
                        defaultDate: moment()
                    });

                    $('#text1').on("dp.change", function (e) {
                        find_text();
                    });
                });
            </script>
<?php
    // 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
    $tmp = $text1 ? "/text1/$text1/page/$page":"/page/$page";
?>
            <form action="" name="form1" method="post">
                <div class="row">
                    <div class="col-3">
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
                        </div>
                    </div>
                    <div class="col-9" align="right">
                        <a class="btn btn-sm mycolor1" href="/jangbuo/add<?php echo $tmp; ?>">추가</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5">
                <tr class="mycolor2">
                    <td width="5%">번호</td>
                    <td width="15%">날짜</td>
                    <td width="30%">제품명</td>
                    <td width="15%">단가</td>
                    <td width="10%">수량</td>
                    <td width="15%">금액</td>
                    <td width="10%">비고</td>
                </tr>

<?php
    // var_dump($lists);
    foreach($lists as $row) : 
        // var_dump($row);
        $no=$row->no;
?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row->writeday; ?></td>
                        <td align="left"><a href="/jangbuo/view/no/<?php echo $no ?><?php echo $tmp; ?>"><?php echo $row->product_name ?></a></td>
                        <td align="right"><?php echo number_format($row->price); ?></td>
                        <td align="right"><?php echo number_format($row->numo); ?></td>
                        <td align="right"><?php echo number_format($row->prices); ?></td>
                        <td align="left"><?php echo $row->bigo; ?></td>
                    </tr>
<?php
    endforeach;
?>
            </table>
            <?php echo $pagination; ?>
