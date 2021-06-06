(function($) {
  'use strict';

  $(document).ready(function() {
    //Initiate Color Picker
    $('.wp-color-picker-field').wpColorPicker();

    //('.chosen-select').chosen({});
    $('.selecttwo-select').select2({
      placeholder: cbxwpbookmark_setting.please_select,
      allowClear: false
    });

    // Switches option sections
   // $('.cbxwpbookmark_setting_group').hide();
    var activetab = '';
    if (typeof (localStorage) !== 'undefined') {
      activetab = localStorage.getItem('cbxwpbookmark');
    }

    //if url has section id as hash then set it as active or override the current local storage value
    if (window.location.hash) {
      if ($(window.location.hash).hasClass('cbxwpbookmark_setting_group')) {
        activetab = window.location.hash;
        if (typeof (localStorage) !== 'undefined') {
          localStorage.setItem('cbxwpbookmark', activetab);
        }
      }
    }


    if (activetab !== '' && $(activetab).length && $(activetab).hasClass('cbxwpbookmark_setting_group')) {
      $('.cbxwpbookmark_setting_group').hide();
      $(activetab).fadeIn();
    }

    /*$('.cbxwpbookmark_setting_group .collapsed').each(function() {
      $(this).find('input:checked').parent().parent().parent().nextAll().each(
          function() {
            if ($(this).hasClass('last')) {
              $(this).removeClass('hidden');
              return false;
            }
            $(this).filter('.hidden').removeClass('hidden');
          });
    });*/

    if (activetab !== '' && $(activetab + '-tab').length) {
      $('.nav-tab-wrapper a.nav-tab').removeClass('nav-tab-active');
      $(activetab + '-tab').addClass('nav-tab-active');
    }

    $('.nav-tab-wrapper a').on('click', function(e) {
      e.preventDefault();

      var $this = $(this);

      $('.nav-tab-wrapper a.nav-tab').removeClass('nav-tab-active');
      $this.addClass('nav-tab-active').blur();

      var clicked_group = $(this).attr('href');

      if (typeof(localStorage) !== 'undefined') {
        localStorage.setItem("cbxwpbookmark", $(this).attr('href'));
      }
      $('.cbxwpbookmark_setting_group').hide();
      $(clicked_group).fadeIn();
    });

    $('.wpsa-browse').on('click', function(event) {
      event.preventDefault();

      var self = $(this);

      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
        title: cbxwpbookmark_setting.upload_title,
        button: {
          text: cbxwpbookmark_setting.please_select
        },
        multiple: false
      });

      file_frame.on('select', function() {
        var attachment = file_frame.state().get('selection').first().toJSON();

        self.prev('.wpsa-url').val(attachment.url);
      });

      // Finally, open the modal
      file_frame.open();
    }); //end file chooser

    //sort photos

    //make the subheading single row
    $('.setting_subheading').each(function(index, element) {
      var $element        = $(element);
      var $element_parent = $element.parent('td');
      $element_parent.attr('colspan', 2);
      $element_parent.prev('th').remove();
    });

    //make the subheading single row
    $('.setting_heading').each(function(index, element) {
      var $element        = $(element);
      var $element_parent = $element.parent('td');
      $element_parent.attr('colspan', 2);
      $element_parent.prev('th').remove();
    });

    $('.cbxwpbookmark_setting_group').each(function(index, element) {
      var $element    = $(element);
      var $form_table = $element.find('.form-table');
      $form_table.prev('h2').remove();
    });

    //var adjustment_photo;
    $('.multicheck_fields_sortable').sortable({
      vertical: true,
      handle: '.multicheck_field_handle',
      containerSelector: '.multicheck_fields',
      itemSelector: '.multicheck_field',
      //placeholder      : '<p class="multicheck_field_placeholder"/>',
      placeholder: 'multicheck_field_placeholder',
    });

    $('.cbxwpbookmark_setting_group').on('click', '.checkbox', function() {
      var mainParent = $(this).closest('.checkbox-toggle-btn');
      if ($(mainParent).find('input.checkbox').is(':checked')) {
        $(mainParent).addClass('active');
      } else {
        $(mainParent).removeClass('active');
      }
    });

    $('#cbxwpbookmark_info_trig').on('click', function(e) {
      e.preventDefault();

      $('#cbxwpbookmark_resetinfo').toggle();

    });

    $('#cbxwpbookmark_autocreate_page').on('click', function(e) {
      e.preventDefault();

      var $this = $(this);
      var $busy = Number($this.data('busy'));

      if ($busy === 0) {
        $this.data('busy', 1);
        $this.addClass('disabled');

        $.ajax({
          type: 'post',
          dataType: 'json',
          url: cbxwpbookmark_setting.ajaxurl,
          data: {
            action: 'cbxwpbookmark_autocreate_page',
            security: cbxwpbookmark_setting.nonce,
          },
          success: function(data, textStatus, XMLHttpRequest) {
            $this.data('busy', 0);
            $this.removeClass('disabled');

            location.reload();

          },
          error: function(jqXHR, textStatus, errorThrown) {
            $this.data('busy', 0);
            $this.removeClass('disabled');

            location.reload();
          },
        });// end of ajax
      }

    });

    //one click save setting for the current tab
    $('#save_settings').on('click', function (e){
      e.preventDefault();

      var $this = $(this);

      var $current_tab = $('.nav-tab.nav-tab-active');
      var $tab_id = $current_tab.data('tabid');
      
      //$('#'+$tab_id).find('.cbxwpbookmark_setting_form').trigger('submit');
      $('#'+$tab_id).find('#submit').trigger('click');

      //console.log($current_tab);
    });

  });//end dom ready
})(jQuery);
