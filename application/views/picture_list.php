            <br>
            <div class="alert mycolor1" role="alert">제품 사진</div>
            
            <script>
                function find_text() {
                    if(!form1.text1.value)
                        form1.action="/product/lists";
                    else
                        form1.action="/product/lists/text1/" + form1.text1.value;
                    form1.submit();
                }
                function zoomimage( iname, pname ) {
                    const w = window.open("/picture/zoom/iname/" + iname + "/pname" + pname, "imageview", "resizable=yes, scrollbars=yes, status=no, width=800, height=600");
                    w.focus();
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

            <div class="row">
            <?php
                // var_dump($lists);
                foreach($lists as $row) : 
                    // var_dump($row);
                    $no=$row->no;
                    $iname = $row->pic ? $row->pic : "noimg.jpg";
                    $pname = $row->name;
            ?>
                <div calss="col-3">
                    <div class="mythumb_box">
                        <a href="javascript:zoomimage('<?php echo $iname; ?>', '<?php echo $pname; ?>');">
                            <img src="/product_img/thumb/<?php echo $iname; ?>" class="mythumb_image">
                        </a>
                        <div class="mythumb_text"><?php echo $pname; ?></div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
            </div>
            <?php echo $pagination; ?>
