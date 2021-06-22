require('../../sass/utils/preloader.scss');

(function() {
    
    let logo = document.querySelector('body')
                       .getAttribute('data-logo');
    
    if( !!(div = document.createElement('div')) ) {
        div.innerHTML = `
            <div id="preloader" key="preloader">
                <img class="logo" src="${logo}">
            </div>
        `;
        document.querySelector('body').appendChild(div);
    }

    window.addEventListener('load', function(e) {
        
        setTimeout(event => {
            if( !!(preloader = document.querySelector('#preloader')) ) {
                preloader.style.transition = '0.8s';
                preloader.style.opacity = '0';
            }
        }, 10);
    
        setTimeout(event => {
            if( !!(preloader = document.querySelector('#preloader')) ) {
                preloader.style.visibility = 'hidden';
            }
            
            if( !!(body = document.querySelector('body')) ) {
                body.style.overflow = 'auto';
            }
        }, 11);

    });

})();
