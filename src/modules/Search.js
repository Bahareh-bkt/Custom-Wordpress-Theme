import $ from "jquery"

class Search {

    constructor(){
        this.addSearchHTML()
        this.openButton = $(".js-search-trigger")
        this.searchOverlay = $(".search-overlay")
        this.isOverlayOpen = false
        this.events()

    }

    events(){
        this.openButton.on("click", this.openOverlay.bind(this))
    }

    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active")
        $("body").addClass("body-no-scroll")
        this.isOverlayOpen = true
    }

    addSearchHTML(){
        $("body").append(`
        <div class="search-overlay">
          <div class="search-overlay__top">
            <div class="container">
              <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
              <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
              <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
            </div>
          </div>
          <div class="container">
            <div id="search-overlay__results"></div>
          </div>
      </div>`)
      }
}

export default Search