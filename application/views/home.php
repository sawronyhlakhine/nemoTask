<div class="container">
    <!-- Page Content goes here -->

    <div class="row" id="cardInfo" style="margin-bottom: 0px;">
        <div class="col s12">
            <div class="card amber accent-3">
                <div class="card-content white-text">
                <span class="card-title" style="color: #333;">Welcome To The <i class="tiny material-icons">beenhere</i> nemo Task</span>
                <p style="color: #333;">This App will help you to arrnge your tasks and will help you to improve your self management.</p>
                </div>
                <div class="card-action blue-grey darken-3">
                <a href="javascript:void(0);" id="gotit">OKay! I Got It.</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding: 10px 0px 0px; margin-bottom: 0px;">
        <div class="col s12">
            <?= form_hidden('toast',$this->session->flashdata('toast')) ?>
            <?= form_open('task/add') ?>
            <div class="row" style="margin-bottom: 0px;">
                <div class="input-field col s10">
                    <i class="material-icons prefix">event_note</i>
                    <?php $error = $this->session->flashdata('task_error') != ''; 
                    ?>
                    <?= ($error) ? 
                        form_input(['id'=>'input_text','type'=>'text','name'=>'taskname','data-length'=>'60', 'required'=>'required', 'value' => $this->session->flashdata('task_name')]) :
                        form_input(['id'=>'input_text','type'=>'text','name'=>'taskname','data-length'=>'60', 'required'=>'required']) 
                    ?>
                    <?= form_label('Task Name', 'input_text') ?>
                    <?php if ($error) { ?>
                        <span class="helper-text" style="color:red;"><?= $this->session->flashdata('task_error') ?></span>
                    <?php } ?>
                    <!-- <input id="input_text" type="text" name="taskname" data-length="60" required> -->
                    <!-- <label for="input_text">Task Name</label> -->
                </div>
                <div class="col s2" style="margin: 1rem 0px;">
                    <button class="btn waves-effect waves-light blue-grey darken-3" type="submit" name="action">Save
                        <i class="material-icons left">save</i>
                    </button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <blockquote style="margin: 0px;">Todo List</blockquote>
            <table class="responsive-table highlight" style="margin-bottom:10px;">
                <thead>
                    <tr>
                        <td>Do</td>
                        <td>Task Name</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td width="10%"><a class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">done</i></a></td>
                        <td width="60%">
                            <strong>Task 1</strong>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><a class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">done</i></a></td>
                                        <td><strong>Task 1.1</strong></td>
                                    </tr>
                                    <tr>
                                        <td><a class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">done</i></a></td>
                                        <td><strong>Task 1.2</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td width="30%">
                            <a class="btn-floating btn-small waves-effect waves-light blue"><i class="material-icons">edit</i></a>
                            <a class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>
                        </td>
                    </tr> -->
                    <?php foreach ($tasks as $task) { ?>
                        <tr>
                            <td><a class="btn-floating btn-small waves-effect waves-light" href="<?=base_url('/task/markdone/'.$task->id)?>"><i class="material-icons">done</i></a></td>
                            <td style="display:flex; align-items: center"><i class="tiny material-icons">label_outline</i>&nbsp;&nbsp;<strong><?= $task->name ?></strong></td>
                            <td>
                                <a class="btn-floating btn-small waves-effect waves-light blue modal-trigger" href="#modal<?=$task->id?>"><i class="material-icons">edit</i></a>
                                <a class="btn-floating btn-small waves-effect waves-light red" href="<?=base_url('/task/delete/'.$task->id)?>"><i class="material-icons">delete</i></a>
                            </td>
                            <!-- Modal Structure -->
                            <div id="modal<?=$task->id?>" class="modal">
                            <?= form_open('task/edit/'.$task->id) ?>
                                <div class="modal-content">
                                    <h4><i class="material-icons prefix">edit</i>&nbsp;Edit Task Name</h4>
                                    <p>A bunch of text</p>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="input-field col s10">
                                                <i class="material-icons prefix">event_note</i>
                                                <?= form_input(['id'=>'edit_text','type'=>'text','name'=>'taskname_edit','data-length'=>'60', 'required'=>'required'], $task->name) ?>
                                                <?= form_label('Task Name', 'edit_text') ?>
                                                <!-- <input id="edit_text" type="text" name="taskname" data-length="60" required> -->
                                                <!-- <label for="edit_text">Task Name</label> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="modal-close waves-effect waves-green btn blue-grey darken-3">Save
                                        <i class="material-icons left">save</i>
                                    </button>
                                </div>
                            <?= form_close ()?>
                            </div>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <blockquote style="margin: 0px;">Completed Tasks</blockquote>
            <table class="responsive-table  highlight">
                <thead>
                    <tr>
                        <td>Task Name</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($done_tasks as $done_task) { ?>
                    <tr>
                        <td width="70%" style="display:flex; align-items: center"><i class="tiny material-icons">done</i> &nbsp; <del><em><?=$done_task->name?></em></del></td>
                        <td width="30%">
                            <a class="btn-floating btn-small waves-effect waves-light blue" href="<?=base_url('/task/undo/'.$done_task->id)?>"><i class="material-icons">undo</i></a>
                            <a class="btn-floating btn-small waves-effect waves-light red" href="<?=base_url('/task/delete/'.$done_task->id)?>"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>