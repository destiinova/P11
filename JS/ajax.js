// FONCTION AJAX pour charger les photos
$('#load-more').on('click', function () {
  currentPage++; //currentPage + 1, car nous voulons charger la page suivante
$.ajax({
  type: 'POST',
  url: 'http://photographe-event.local/wp-admin/admin-ajax.php',
  dataType: 'html',
  data: {
    action: 'weichie_load_more',
    paged: currentPage,
  },
  success: function (res) {
    $('.photo_toutephoto').append(res);
  }
});
});
console.log('test')



// Filtre Catégorie 

jQuery('#cat1, #format1, #date1').on('change', function() {
  var categorie = jQuery('#cat1').val();
  var format = jQuery('#format1').val();
  var date = jQuery('#date1').val();

  var data = {
    action: 'filter_post',
    categorie: categorie,
    format: format,
    date: date // Ajout de la clé 'date' avec la valeur sélectionnée
  };

  jQuery.ajax({
    type: 'POST',
    url: 'http://photographe-event.local/wp-admin/admin-ajax.php',
    data: data,
    success: function(res) {
      $('.photo_toutephoto').html(res);
      $('.chargerplus').empty();
    }
  });
});

