            <br>
            <div class="alert mycolor1" role="alert">Ajax 구분</div>
<?php
    // 회원 추가/ 수정 / 삭제 후에도 검색한 결과 화면으로 오기 위해 ...
    $tmp = $text1 ? "/text1/$text1/page/$page":"/page/$page";
?>
            
            <script>
                function find_text() {
                    if(!form1.text1.value)
                        form1.action="/ajax/lists";
                    else
                        form1.action="/ajax/lists/text1/" + form1.text1.value;
                    form1.submit();
                }

                $(function() {
                    $("#ajax_add").click( function() {
                        var name = $("#name").val();
                        
                        $.ajax({
                            url: "/ajax/ajax_insert",
                            type: "POST",
                            data: { "name" : name },
                            dataType: "html",
                            complete: function(xhr, textStatus) {
                                var no = xhr.responseText;

                                $("#table_list").append(
                                    "<tr id='rowno"+no+"'>"+
                                    "    <td>"+no+"</td>"+
                                    "    <td><a href='/ajax/view/no/"+no+"<?php echo $tmp; ?>'>"+name+"</a></td>"+
                                    "    <td><a href='#' rowno='"+no+"' class='ajax_del btn btn-sm mycolor1' onclick='javascript:confirm(\"삭제할까요?\");'>삭제</a></td>"+
                                    "</tr>"
                                );

                                $("#name").val('');
                            }
                        });
                    });

                    $("#table_list").on("click", ".ajax_del", function() {
                        $.ajax({
                            url: "/ajax/ajax_delete",
                            type: "POST",
                            data: { "no" : $(this).attr("rowno") },
                            dataType: "text",
                            complete: function(xhr, textStatus) {
                                var no = xhr.responseText;
                                $("#rowno"+no).remove();
                            }
                        });
                    });
                });

            </script>

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
                        <!--
                        <a class="btn btn-sm mycolor1" href="/ajax/add<?php echo $tmp; ?>">추가</a>
                        -->
                        <a href="#collapseExample" class="btn btn-sm mycolor1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">추가</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-sm mymargin5" id="table_list">
                <tr class="mycolor2">
                    <td width="10%">번호</td>
                    <td width="80%">이름</td>
                    <td width="10%">삭제</td>
                </tr>

                <?php
                    // var_dump($lists);
                    foreach($lists as $row) : 
                        // var_dump($row);
                        $no=$row->no;
                ?>
                    <tr id="rowno<?php echo $no; ?>">
                        <td><?php echo $no ?></td>
                        <td><a href="/ajax/view/no/<?php echo $no ?><?php echo $tmp; ?>"><?php echo $row->name ?></a></td>
                        <td>
                        <a href="#" rowno="<?php echo $no; ?>" class="ajax_del btn btn-sm mycolor1" onclick="javascript:confirm('삭제할까요?');">삭제</a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                ?>
            </table>

            <div class="collapse mymargin5" id="collapseExample">
                <div class="card card-body" style="padding:0px 5px 0px 5px;">
                    <table class="table table-sm table-bordered alert-primary mymargin5">
                    <form name="form2">
                        <tr>
                            <td width="10%">이름</td>
                            <td width="80%">
                                <input type="text" name="name" value="" id="name" class="form-control form-control-sm">
                            </td>
                            <td width="10%" style="vertical-align:middle">
                                <a href="#" id="ajax_add" class="btn btn-sm btn-primary">저장</a>
                            </td>
                        </tr>
                    </form>
                    </table>
                </div>
            </div>

            <?php echo $pagination; ?>
