<?php
if(!isset($_POST['button']))
{ ?>
						<form id="reg_form" style="text/css" method="post" enctype="multipart/form-data">
							<fieldset class="joomly ui-sortable">
							<input type="hidden" name="option" value="com_joomlyform" class="ui-sortable-handle" style="">
							<input type="hidden" name="page" value="<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" class="ui-sortable-handle" style="">
							<input type="hidden" name="ip" value="<?php echo $_SERVER["REMOTE_ADDR"];?>" class="ui-sortable-handle" style="">
							<input type="hidden" name="form_id" value="4lab" class="ui-sortable-handle" style="">
							<input type="hidden" name="task" value="add.save" class="ui-sortable-handle" style="">
							<div class="active" data-element="button" data-id="button2" style="">
                            							<button type="submit" class="" id="button2" style="margin-left: auto; margin-right: 0px; height: 48px;">Size</button>
                            							</div>

                            							<div class="p" data-element="p" data-id="p1" style="">
                            							<p class="" id="p1">My form for 4th lab</p>
                            							</div>

                            							<div class="input" data-element="input" data-id="input1">
                            							<label for="input1">Name user</label>
                            							<input type="text" name="input1" id="input1" class="" placeholder="">
                            							</div>

                            							<div class="input" data-element="input" data-id="input2">
                            							<label for="input2">Message subject</label>
                            							<input type="text" name="input2" id="input2" class="" placeholder="">
                            							</div>

                            							<div class="textarea" data-element="textarea" data-id="textarea1" style="">
                            							<label for="textarea1">Message</label>
                            							<textarea name="textarea1" id="textarea1" class="" placeholder="" rows="5" cols="30"></textarea>
                            							</div>

                            							<div class="" data-element="button" data-id="button1"><button type="submit" class="" id="button1">Send</button>
                            							</div>
							</fieldset>
						</form>
						<? } else
                        {
                        //проверяете и т.д. - делаете необходимые действия
                        }
                        ?>
					</div>