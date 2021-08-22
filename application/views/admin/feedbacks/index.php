<section class="content pb-3">

  <div class="container">
    <div class="row">

      <?php foreach ($feedback_labels as $labels) : ?>
        <div class="col-md-3 ml-1">
          <i class="fa fa-square " style="color:<?= $labels->label_color ?>"></i>
          <?= $labels->label_name ?>
        </div>
      <?php endforeach; ?>
    </div>

  </div>


  <div class="container-fluid h-100 row">

    <div class="col-md-12">
      <div class="card card-row card-secondary">
        <div class="card-header">
          <h3 class="card-title">
            Backlog
          </h3>
        </div>
        <div class="card-body">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h5 class="card-title">Labels</h5>
              <div class="card-tools">
                <span class="btn btn-tool btn-link">Add a problem</span>
                <a class="btn btn-tool create-backlog">
                  <i class="fas fa-plus-circle"></i>
                </a>
              </div>
            </div>
            <div class="create-div-backlog">
              <div class="input-group input-group-md row">
                <div class="col-md-6 col-sm-6">
                  <input type="text" name="backlog" id="backlog" class="form-control form-control-border" placeholder="Enter your query..">
                </div>

                <span class="input-group-append">
                  <select id="backlog_label" class="custom-select form-control-border">
                    <?php foreach ($feedback_labels as $labels) : ?>
                      <option value="<?= magicfunction($labels->label_id, 'e') ?>"> <?= $labels->label_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </span>
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat add-backlog load-btn">Add!</button>
                </span>
              </div>
<hr>
            </div>
            <div class="card-body">

              <ul class="list-backlogs">

              </ul>

            </div>
          </div>



        </div>
      </div>
    </div>

    <?php foreach ($feedback_types as $types) : ?>
      <div class="col-md-6">
        <div class="card card-row card-<?= $types->type_color  ?>">
          <div class="card-header">
            <h3 class="card-title">
              <?= $types->type_name ?>
            </h3>
          </div>

          <div class="card-body">
            <div class="card card-<?= $types->type_color  ?> card-outline">
              <div class="card-header">
                <h5 class="card-title">List</h5>
                <div class="card-tools">
                  <a class="btn btn-tool btn-link">All <?= $types->type_name ?> will be listed here</a>

                </div>
              </div>
              <div class="card-body">
                <ul data-id="<?= magicfunction($types->type_id, 'e') ?>" class="feedback-types" id="list-feedbacks<?= magicfunction($types->type_id, 'e') ?>">

                </ul>

              </div>
            </div>



          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<script>
  $(document).ready(function() {
    loadBacklogs();
  });


  $(document).on('change', '.change-feedback-type', function(e) {
    var this_option = $(this);
    changeFeedbackType(this_option);
    e.preventDefault();
  });


  $(document).on('click', '.create-backlog', function(e) {
    var itag_close = '<i class="fas fa-times"></i>';
    var itag_open = '<i class="fas fa-plus-circle"></i>';
    var itag = ( $($(this)).html() == itag_close) ? itag_open:itag_close;
    $($(this)).html(itag);
    $('.create-div-backlog').toggle();
    e.preventDefault();
  });

  $(document).on('click', '.add-backlog', function(e) {
    addBacklog();
    e.preventDefault();
  });

  function changeFeedbackType(this_option) {
    var f_id = this_option.attr('data-id');
    var f_type = this_option.val();
    var fbtype_xhr = $.post('<?= base_url('change_feedback_status'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
      f_id: f_id,
      f_type: f_type
    })

    fbtype_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      $(this_option).notify(
        out.msg, {
          className: out.status,
          position: "bottom"
        }
      );
      $('#backlog').val('');
      loadBacklogs();
    });

    fbtype_xhr.fail(function() {
      alert("there seems to be some problem");
    });
  }

function addBacklog() {
    var fbadd_xhr = $.post('<?= base_url('add_backlog'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
      backlog: $('#backlog').val(),
      backlog_label: $('#backlog_label').val()
    })

    fbadd_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      $(".add-backlog").notify(
        out.msg, {
          className: out.status,
          position: "bottom"
        }
      );
      $('#backlog').val('');
      loadBacklogs();
    });

    fbadd_xhr.fail(function() {
      alert("there seems to be some problem");
    });
  }


  function loadBacklogs() {
    var fbload_xhr = $.post('<?= base_url('list_backlogs'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
      feedback_type: 0

    })

    fbload_xhr.done(function(data) {
      $('.list-backlogs').html(data);
      loadAllFeedbackTypes();
    });

    fbload_xhr.fail(function() {
      alert("there seems to be some problem");
    });
  }

  function loadAllFeedbackTypes() {
    var feedback_type = '';
    $(".feedback-types").each(function() {
      feedback_type = ($(this).attr('data-id'));
      loadFeedbackByTypes(feedback_type);
    });
  }

  function loadFeedbackByTypes(type) {
    var fbload_type_xhr = $.post('<?= base_url('list_backlogs'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
      feedback_type: type

    })

    fbload_type_xhr.done(function(data) {
      var feed_back_list_data = '#list-feedbacks' + type;
      $(feed_back_list_data).html(data);
    });

    fbload_type_xhr.fail(function() {
      alert("there seems to be some problem");
    });
  }
</script>