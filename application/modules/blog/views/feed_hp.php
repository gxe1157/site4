<h1>The Blog</h1>
<?php
$this->load->module('timedates');
$this->load->module('blog');

foreach($query->result() as $row){
  $article_preview = word_limiter( $row->page_content, 25);
  $image =  $row->picture;
  $small_pic_path = $this->blog->_get_thumbnail_path( $image );  
  $date_published = $this->timedates->get_nice_date($row->date_published, 'mini' );
  $blog_url = base_url().'blog/article/'.$row->page_url;

  ?>
  <div class="row">
    <div class="col-md-3">
      <img src="<?= base_url().$small_pic_path ?>" class="img-responsive img-thumbnail">
    </div>
    <div class="col-md-9">

      <h4><a href="<?= $blog_url ?>"><?= $row->page_title ?></a></h4>

      <p style="color: #000; font-size: 0.9em;"><?= $row->author ?> - <span style="color: #999;"><?= $date_published ?></span></p>
      <p><?= $article_preview ?></p>      
    </div>
  </div>

<?php
}
?>
