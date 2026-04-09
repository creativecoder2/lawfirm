<div class="content-header">
    <h1>
        Chat Conversation Thread
        <small>Viewing full interaction for session <?= mb_strimwidth($session_id, 0, 10, "...") ?></small>
    </h1>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    <i class="fa fa-comments"></i> 
                    <?php if(!empty($chats[0]['user_name'])): ?>
                        Conversation with <strong><?= $chats[0]['user_name'] ?></strong> (<?= $chats[0]['user_phone'] ?>)
                    <?php else: ?>
                        Conversation with Guest
                    <?php endif; ?>
                </h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('admin/chatbot_history') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to History</a>
                </div>
            </div>
            <div class="box-body" style="background: #f4f7f6; padding: 20px;">
                <div class="direct-chat-messages" style="height: 500px; max-height: 70vh; overflow-y: auto; padding: 10px;">
                    
                    <?php foreach($chats as $chat): ?>
                        
                        <!-- User Message -->
                        <div class="direct-chat-msg right mb-4">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right"><?= $chat['user_name'] ?: 'User' ?></span>
                                <span class="direct-chat-timestamp pull-left"><?= date('h:i A', strtotime($chat['created_at'])) ?></span>
                            </div>
                            <img class="direct-chat-img" src="https://ui-avatars.com/api/?name=User&background=3c8dbc&color=fff" alt="User Image">
                            <div class="direct-chat-text" style="background: #3c8dbc; border-color: #3c8dbc; color: #fff; margin-right: 50px; margin-left: 0;">
                                <?= htmlspecialchars($chat['message']) ?>
                            </div>
                        </div>

                        <!-- Bot Response -->
                        <div class="direct-chat-msg mb-4">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">Legal Eagle AI</span>
                                <span class="direct-chat-timestamp pull-right"><?= date('h:i A', strtotime($chat['created_at'])) ?></span>
                            </div>
                            <img class="direct-chat-img" src="<?= base_url('assets/images/logo/logo-2.png') ?>" alt="Bot Image" style="background: #fff; padding: 2px;">
                            <div class="direct-chat-text" style="background: #fff; color: #444; border-color: #ddd; margin-left: 50px; margin-right: 0;">
                                <?= nl2br($chat['response']) ?>
                                
                                <?php 
                                $links = json_decode($chat['links_json'], true);
                                if(!empty($links)): ?>
                                    <div style="margin-top: 10px; border-top: 1px solid #eee; padding-top: 5px;">
                                        <small style="display:block; margin-bottom: 5px; color: #888;">Buttons Sent:</small>
                                        <?php foreach($links as $l): ?>
                                            <a href="<?= $l['url'] ?>" target="_blank" class="btn btn-xs btn-outline-primary" style="margin-bottom: 3px; border: 1px solid #3c8dbc; color: #3c8dbc; display: inline-block; padding: 2px 8px; border-radius: 10px; text-decoration: none; font-size: 10px;">
                                                <?= $l['title'] ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
            <div class="box-footer text-center">
                <p class="text-muted small">
                    This conversation lasted from <strong><?= date('d M Y, h:i A', strtotime($chats[0]['created_at'])) ?></strong> 
                    to <strong><?= date('d M Y, h:i A', strtotime(end($chats)['created_at'])) ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
.mb-4 { margin-bottom: 25px !important; }
.direct-chat-msg { position: relative; margin-bottom: 10px; }
.direct-chat-info { display: block; margin-bottom: 2px; font-size: 12px; }
.direct-chat-img { border-radius: 50%; float: left; width: 40px; height: 40px; }
.right .direct-chat-img { float: right; }
.direct-chat-text { border-radius: 5px; position: relative; padding: 10px 15px; margin: 5px 0 0 50px; border: 1px solid #d2d6de; }
.right .direct-chat-text { margin-right: 50px; margin-left: 0; }
.direct-chat-text:after, .direct-chat-text:before { position: absolute; right: 100%; top: 15px; border: solid transparent; content: " "; height: 0; width: 0; pointer-events: none; }
.right .direct-chat-text:after, .right .direct-chat-text:before { right: auto; left: 100%; }
.direct-chat-text:after { border-width: 5px; margin-top: -5px; }
.direct-chat-text:before { border-width: 6px; margin-top: -6px; }

/* Bot Triangle */
.direct-chat-msg:not(.right) .direct-chat-text:after { border-right-color: #fff; }
.direct-chat-msg:not(.right) .direct-chat-text:before { border-right-color: #ddd; }

/* User Triangle */
.direct-chat-msg.right .direct-chat-text:after { border-left-color: #3c8dbc; }
.direct-chat-msg.right .direct-chat-text:before { border-left-color: #3c8dbc; }
</style>
