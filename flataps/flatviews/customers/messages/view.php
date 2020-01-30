<?php
$header = array('title' => 'Messages');
$this->external->set_css(base_url().'css/messages.css');
$this->load->view('includes/header', $header);
?>
<body>
<?php  $this->load->view('includes/pages_inner_header');?>
	<div class="full-row deshbord">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 col-xl-2 bg-primary">
					<?php $this->load->view('includes/sidebar');?>
				</div>
			<div class="col-md-11 col-xl-10 bg-gray">
			    <?php $this->message_output->run(); ?> 
					<div class="row">
						<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Messages<?php if($customer_name) {?>(<?php echo $customer_name;?>)<?php } ?></h4>
							<?php 
							if($user_latest_messages){?>
							<div class="messaging" id="#messages_div">
      <div class="inbox_msg">
        <div class="inbox_people">
         
          <div class="inbox_chat">
            <?php
             foreach($user_latest_messages as $key =>  $lists){
             
             ?>  
            <div class="chat_list active_chat">
                <a href="<?php echo customer_path();?>messages/detail/<?php echo $key; ?>/<?php echo $lists['profile_id'];?>" alt="<?php echo $lists['name'];?>">
              <div class="chat_people">
                <div class="chat_img">
                <?php if($lists['photo']==''){ 
                      echo '<img src="'.base_url().'images/user-profile.png">';
                        }
                      else{
                      echo  '<img src="'.base_url().CNTPHT_THUMB.$lists['photo'].'">';
                      }
                      
                      ?> </div>
                <div class="chat_ib">
                  <h5> <?php echo $lists['name'];?><?php if($lists['total_messages_unread'] >0 ){ echo '<span class="msgCount">'.$lists['total_messages_unread'].'</span>'; }?> <span class="chat_date"><?php echo date('M d',strtotime($lists['entry_time']));?></span></h5>
                  <?php if($lists['message_status']=='0'){ ?>
                       <p style="color:#000;"><?php echo $lists['message_body'];?> </p>
                  <?php } elseif($lists['message_status']=='1'){ ?>
                       <p><?php echo $lists['message_body'];?> </p>
                  <?php } ?>
                </div>
              </div>
              </a>
            </div>
            <?php }  ?>
          </div>
        </div>
        <div class="mesgs">
            
          <div class="msg_history">
              <?php
              $user_id       = $this->session->userdata('s_user_id');  
              if($from_id){
                 $usres_chat_histpory = $this->messages_model->chat_history($from_id);	
                  if( $usres_chat_histpory['data']){
                     foreach( $usres_chat_histpory['data'] as $history){?>
                       <?php if($history['from_id']==$user_id){ ?>
                        <div class="outgoing_msg">
                          <div class="sent_msg">
                              <p><?php echo $history['message_body'];?></p>
                              <span class="time_date"> <?php echo date('h:i A',strtotime($history['entry_time']));?>    |    <?php echo date('M d',strtotime($history['entry_time']));?></span>
                          </div>
                        </div>
                       
                        <?php } else{?>
                    <div class="incoming_msg">
                          <div class="received_msg">
                            <div class="received_withd_msg">
                              <p><?php echo $history['message_body'];?></p>
                              <span class="time_date"> <?php echo date('h:i A',strtotime($history['entry_time']));?>    |    <?php echo date('M d',strtotime($history['entry_time']));?></span></div>
                          </div>
                        </div>
                      
                        <?php } ?>
                       <?php 
                      
                     }
                  }
                  
              }
              
              else{
               ?>
               <p>Welcome to your inbox</p>
               <p>To get started click a conversation on the left.</p>
               <?php
                 }
                ?>
          </div>
         
         <?php if($from_id){ ?>
					<?php  $attributes = array('class'=>'form9','id' => 'replyfrm','name' => 'replyfrm','autocomplete' => 'off','method'=>'post');
		        	 echo form_open(customer_path()."messages/reply/".$from_id."/".$profile_id."/submit", $attributes);
			         ?> 
			         
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message"  name="message_data" id="message_data" required/>
              <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
          <?php echo form_close();?>
          
          <?php } ?>
        </div>
      </div>

      
    </div>
							<?php } else { ?>
							<p>You don't have any messages yet!<br>Pick your favourite listings and start messaging to begin your search.</p>
							<?php } ?>
						</div>
						
					</div>
				</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
if($from_id){
 $below_app_js=array('js/jquery.validate.min.js','js/message_scroll.js');
 $this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); 
}
else{
 $below_app_js=array();
 $this->load->view('includes/footer',array('below_app_js'=>$below_app_js));    
}
?>