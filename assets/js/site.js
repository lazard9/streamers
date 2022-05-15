jQuery(function ($) {
  // Smoot scroll
  require("./_site/smootScroll");

  // Site Header
  require("./_site/siteHeader");

  // Single streamer profile
  require("./_site/streamerProfile");

  // Modal
  require("./_site/modal");

  // Ajax load more
  require("./_site/loadMore");

  // Streamers filter
  const filters = require("./_site/streamersFilter");
  filters.init();

  // Ajax load more
  require("./_site/paginateLinks");
});
