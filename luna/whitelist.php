<?php

define('LUNA_ROOT', dirname(__FILE__).'/');
require LUNA_ROOT.'include/common.php';

$page_title = $luna_config['o_board_title'].' / Whitelist';

require load_page('header.php');

if ($luna_user['is_guest']) { // User is a guest. Cannot whitelist.
    echo "<div>Sorry, but guests can't whitelist. Please register or log in and try again.</div>";
}else{ 
    ?>
    <div class="index profile-header container-fluid">
        <div class="jumbotron profile">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="username">WHITELIST</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main index profile container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 sidebar">
                <div class="container-avatar" style="position: relative; z-index: 2;">
                    <?php echo draw_user_avatar($luna_user['id'], true, 'img-avatar img-center'); ?>
                </div>
                <div class="title-block title-block-primary" style="position: relative; top: -35px; z-index: 1;">
                    <h2>
                        <p class="text-center">
                            <?php echo $luna_user['username']; ?>
                        </p>
                    </h2>
                </div>
            </div>
    
            <div class="col-xs-12 col-sm-9">
                
                <?php
                    if($luna_user["uuid"] != "") { // Already whitelisted
                        ?>
                        You're all whitelisted and ready to go! You can join the server now.
                        <?php
                    }else{
                ?>
                    Please make sure you're logged into the right account! Once you whitelist, your Minecraft username will be <strong>permanently</strong> associated with your forum account.<br><br>
                    Enter your <strong>Minecraft username</strong> here:

                    <input type="text" id="mcusername" class="form-control" aria-describedby="mcusername_whitelist_help" placeholder="Minecraft Username">
                    <span id="mcusername_whitelist_help" class="help-block">Double check it and make sure it isn't mispelled.</span>

                    Click this button to automatically retrieve your UUID from your username: (this also serves to check that you didn't mispell your username)<br>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-4">
                                <button id="grab_uuid" class="btn btn-primary form-control" type="submit">Grab my UUID</button>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" id="mcuuid_whitelist" class="form-control" placeholder="My UUID" value="" disabled>
                            </div>
                        </div>
                    </div><br>

                    Once you've got your UUID up there, you can click this pretty button to finally whitelist yourself. 
                    Take a moment to reflect on how far you've come to whitelist yourself and how the experience has changed you as a person. 
                    Take another moment to check your username again and make sure its the one you want to associate with this forum account. 
                    Click the button when you're ready.
                    <button id="whitelist_finish" class="btn btn-primary form-control" type="submit">Whitelist me!</button>
                <?php } ?>
                <div style="height: 15px;">
                    <!-- Intentionally left blank. -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#grab_uuid").on("click", function(){
            if($("#mcusername").val() != ""){
                var name = $("#mcusername").val();
                $.get("minecraft/get_uuid.php?username="+name, function(uuid){
                    $("#mcuuid_whitelist").val(uuid);
                    
                    $("#whitelist_finish").on("click", function(){
                        $.get("minecraft/complete_whitelist.php?uuid="+uuid, function(data){
                            window.location.reload(true); 
                        });
                    });
                });
            }
        });
    </script>
    <?php
}

require load_page('footer.php');