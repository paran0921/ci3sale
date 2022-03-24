
            <br>
            <div class="alert mycolor1" role="alert">매출장</div>

            <script>
                $(function() {
                    $('#writeday').datetimepicker({
                        locale: 'ko',
                        format: 'YYYY-MM-DD',
                        defaultDate: moment()
                    });
                });
                
                function cal_prices()
                {
                    form1.prices.value = Number(form1.price.value) * Number(form1.numo.value);
                    form1.bigo.focus(); 
                }
                
                function find_product()
                {
                    window.open("/findproduct", "", "resizable=yes, scrollbars=yes, width=500, height=600");
                }
            </script>

            <form action="" name="form1" method="post" class="form-inline">
                <table class="table table-bordered table-sm mymargin5">
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">번호</td>
                        <td width="80%" align="left"><?php echo $row->no; ?></td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>날짜</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                        <div class="input-group input-group-sm date" id="writeday">
                            <input type="text" name="writeday" value="<?php echo $row->writeday; ?>" class="form-control form-control-sm">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                                </div>
                            </div>
                        </div>
                        <?php if(form_error("writeday")==TRUE) echo form_error("writeday"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle"><font color="red">*</font>제품명</td>
                        <td width="80%" align="left">
                            <div class="form-inline">
                                <input type="hidden" name="product_no" value="<?php echo $row->product_no; ?>">
                                <input type="text" name="product_name" id="product_name" value="<?php echo $row->product_name; ?>" class="form-control form-control-sm" disabled>
                                <input type="button" value="제품찾기" onClick="find_product();" class="form-control btn btn-sm mycolor1">
                            </div>
                        <?php if(form_error("product_no")==TRUE) echo form_error("product_no"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">단가</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                        <input type="text" name="price" value="<?php echo $row->price; ?>" class="form-control form-control-sm" onchange="cal_prices();">
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">수량</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                        <input type="text" name="numo" value="<?php echo $row->numo; ?>" class="form-control form-control-sm" onchange="cal_prices();">
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">금액</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                        <input type="text" name="prices" value="<?php echo $row->prices; ?>" class="form-control form-control-sm" readonly style="border:0">
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mycolor2" width="20%" style="vertical-align:middle">비고</td>
                        <td width="80%" align="left">
                        <div class="form-inline">
                        <input type="text" name="bigo" value="<?php echo $row->bigo; ?>" class="form-control form-control-sm">
                        </div>
                        </td>
                    </tr>
                </table>

                <div align="center">
                    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
                    <input type="button" value="이전화면으로" class="btn btn-sm mycolor1" onclick="history.back();">
                </div>
            </form>
