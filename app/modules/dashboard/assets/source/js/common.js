$(document).ready(function(){
    // Bootstrap tab activation
    var hash = location.hash
        , hashPieces = hash.split('?')
        , activeTab = $('[href=' + hashPieces[0] + ']');
    activeTab && activeTab.tab('show');
})