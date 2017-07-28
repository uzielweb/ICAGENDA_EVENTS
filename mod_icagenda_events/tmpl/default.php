<?php
defined('_JEXEC') or die;
jimport( 'joomla.html.html.content' );
$show_image = $params->get('show_image');
$show_date = $params->get('show_date');
$show_title = $params->get('show_title');
$show_location = $params->get('show_location');
$show_description = $params->get('show_description');
$show_time = $params->get('show_time');
$show_feature = $params->get('show_feature');
$show_read_more = $params->get('show_read_more');
$mymenuitem = $params->get('mymenuitem');
$limit = $params->get('limit');

$count = '0';



foreach ($objects as $key => $item) {
  if (($item->startdate == '0000-00-00 00:00:00') and ($item->enddate == '0000-00-00 00:00:00')){
  $dates = unserialize($item->dates);
  }
  if (($item->startdate != '0000-00-00 00:00:00') and ($item->enddate != '0000-00-00 00:00:00')){
  $dates = array($item->startdate);
  }

  foreach ($dates as $kd => $date) {
    if (($item->state == '1') and ($date != '0000-00-00 00:00:00') and ($date >= gmdate('Y-m-d H:i:s'))){

      $count  = $count+1;

      $myitems[$count] = $item;
      $mydates[$count] = $date;

    }

  }

}
?>
<?php asort($mydates);?>
<?php $cont = '0';?>
<?php foreach ($mydates as $co => $mydate) : ?>
  <?php foreach ($myitems as $ki => $myitem) : ?>
    <?php if ($ki == $co) :?>
      <?php  $cont = $cont+1;?>
      <?php if ($cont <= $limit) : ?>
      <div class="row-fluid myev-out">
        <?php if ($show_image == '1') :?>
        <div class="col-md-3 col-xs-12 myev-image-out">
          <div class="img-thumbnail myev-image myev-inner">
            <img src="<?php echo $myitem->image; ?>" alt="<?php echo $myitem->title; ?>" title="<?php echo $myitem->title; ?>" />

          </div>
        </div>
        <?php endif; ?>
        <?php if ($show_date == '1') : ?>
        <div class="col-md-2 col-xs-12 myev-dmy-out">
            <div class="myev-inner">

          <p class="myev-day">
            <?php echo JHtml::date($mydate,"d",'UTC'); ?>
          </p>
          <p class="myev-month-year">
            <?php echo JHtml::date($mydate,"F Y",'UTC'); ?>
          </p>
          <?php if (($myitem->startdate != '0000-00-00 00:00:00') and ($myitem->enddate != '0000-00-00 00:00:00')) : ?>

            <p class="myev-until">
            <?php echo JText::_('UNTILL').' '.JHtml::date($myitem->enddate,"d-m-Y",'UTC') ; ?>
            <?php
            $totalweekdays ='0';
            $weekdays = explode(',',$myitem->weekdays);
            foreach ($weekdays as $kw => $weekday) {
              $totalweekdays = $totalweekdays+1;
            switch ($weekday) {
              case '1':
                $weekday = "Sun";
              break;
              case '2':
                $weekday = "Mon";
              break;
              case '3':
                $weekday = "Tue";
              break;
              case '4':
                $weekday = "Wed";
              break;
              case '5':
                $weekday = "Thu";
              break;
              case '6':
                $weekday = "Fri";
              break;
              case '7':
                $weekday = "Sat";
              break;

            }

            if ($totalweekdays%(count($weekdays)) == '0'){
              echo JHtml::date($weekday,"D",'UTC');
            }
            else{
              echo JHtml::date($weekday,"D",'UTC').',';
            }

            }
            ?>


            </p>
        <?php endif; ?>

        </div>
        </div>
      <?php endif; ?>
      <?php if (($show_title == '1') or ($show_location == '1') or ($show_description == '1')) :?>
        <div class="col-md-3 col-xs-12 myev-place-out">
          <div class="myev-inner">
              <?php if ($show_title == '1') :?>
          <h4><?php echo $myitem->title; ?></h4>
        <?php endif; ?>
          <?php if ($show_location == '1') :?>
          <p class="myev-place">
            <?php echo $myitem->place; ?>
          </p>
          <?php endif; ?>
          <?php if ($show_description == '1') :?>
          <div class="myev-short-desc">
            <?php echo JHtmlContent::prepare($myitem->shortdesc); ?>
          </div>
          <?php endif; ?>
        </div>
        </div>
      <?php endif; ?>
      <?php if (($show_time == '1') or ($show_feature == '1')) :?>
        <div class="col-md-2 col-xs-12 myev-time-feature-out">
            <div class="myev-inner">

            <?php if ($show_time == '1') :?>
          <p class="myev-time">
            <?php echo JHtml::date($mydate,"H",'UTC').'h'.JHtml::date($mydate,"i",'UTC') ; ?>
          </p>
        <?php endif; ?>
        <?php if ($show_feature == '1') :?>
          <p class="myev-feature">
            <?php
              foreach ($objects2 as $co2 => $o2) {
                foreach ($objects3 as $co3 => $o3) {
                  if (($o2->event_id == $myitem->id) and ($o3->id == $o2->feature_id)){
                    echo $o3->title.'<br />';

                  }
                }
              }
            ?>
          </p>
        <?php endif ;?>
        </div>
        </div>
      <?php endif; ?>
      <?php if ($show_read_more == '1') :?>
        <div class="col-md-2 col-xs-12 myev-button-out">
            <div class="myev-inner">
          <a class="btn button myev-button" href="<?php echo JRoute::_().'index.php?option=com_icagenda&view=event&id='.$myitem->id.'&Itemid='.$mymenuitem;?>" target="_self">
            <?php echo JText::_('READ_MORE'); ?>
          </a>
        </div>
      </div>
    <?php endif; ?>
      </div>
      <?php endif;?>
    <?php endif;?>

<?php endforeach;?>
<?php endforeach;?>
