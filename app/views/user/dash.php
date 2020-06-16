<?php include VIEW . 'user/teamplate/header.php'; ?>
    <script src="/public/JS/organizeDash.js">
		</script>
    <link rel="stylesheet" href="/public/css/organizeDash.css">
    
    <div class="container">
            <div class="row">
                <div class="column-pic">
                    <img class="profilePic" id="profilePicture" src="/public/img/user.png">
                </div>
                <div class="column-pic-1">
                <?php if(isset($this->user)):?>
                    <h2><?=$this->user->userName." ".$this->user->userSurname;?></h2>
                    <p><?=$this->user->type; ?></p>
                 <?php endif;?>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <nav class="nav nav-pills justify-content-right">
                <button class="button" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus-circle"></i> New</button>
                <button class="button" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
                <button class="button" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
            </nav>
        </div>
        <br>
        <div class="main">
            <div class="container" id="dayContainer">
                <div class="row" id="row">
                <?php for($count=0;$count<count($this->cards);$count++):?>
					          <button id="<?=$this->cards[$count]->Todo_ID; ?>" href="<?=$this->makeUrl("user/todo/{$this->cards[$count]->Todo_ID}");?>" class="column">
                        <h2><?=$this->cards[$count]->Card_Name; ?></h2>
                        <p><?=$this->cards[$count]->Card_Description; ?></p>
                    </button>
                    <script>
                      document.getElementById("<?=$this->cards[$count]->Todo_ID;?>").onclick = function(){
                        window.location.href="<?=$this->makeUrl("user/todo/{$this->user->ID}/{$this->cards[$count]->Todo_ID}"); ?>";
                      }
                    </script>
                  <?php endfor;?>
                </div>
            </div>
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="form">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="createModalLabel">New day</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" role="form">
                      <form method="POST" action="<?=$this->makeUrl("user/createCard/{$this->user->ID}");?>">
                        <div class="form-group">
                          <label for="card-name" class="col-form-label">Name:</label>
                          <input name="cardName" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="card-description" class="col-form-label">Description</label>
                            <input name="cardDesc" type="text" class="form-control" id="description">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="button" style="font-size: 24px;" data-toggle="modal" data-target="#createModal" onclick="createNewcard()">Create</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    
<?php include VIEW. 'user/teamplate/footer.php'; ?>