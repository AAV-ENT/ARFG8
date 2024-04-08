
function openMenu() {
  $('#hamburgerMenu').removeClass('hidden');
  $('#hamburgerMenu').addClass('flex');
  $('body').removeClass('overflow-x-hidden');
  $('body').addClass('overflow-hidden');
}

function closeMenu() {
  $('#hamburgerMenu').addClass('hidden');
  $('#hamburgerMenu').removeClass('flex');
  $('body').addClass('overflow-x-hidden');
  $('body').removeClass('overflow-hidden');
}

$(document).on('click', function(e) {
  if ($(e.target).closest('#langChoseButton').length) {
    $('#langChose').removeClass('hidden');
  }else if (!$(e.target).closest('#langChoseButton').length) {
    $('#langChose').addClass('hidden');
  }
});

$(document).on('click', function(e) {
  if ($(e.target).closest('#buttonDropdownMenu').length) {
    $('#showBurgerDrowpdownLang').removeClass('hidden');
  }else if (!$(e.target).closest('#buttonDropdownMenu').length) {
    $('#showBurgerDrowpdownLang').addClass('hidden');
  }
});
