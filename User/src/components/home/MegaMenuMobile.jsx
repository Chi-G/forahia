import React, { Component, Fragment } from 'react'

class MegaMenuMobile extends Component {

  // binding it to the constructor
  constructor(){
    super();
    this.MegaMenu = this.MegaMenu.bind(this);
  }

  componentDidMount(){
    this.MegaMenu();
  }

  MegaMenu(){
    var acc = document.getElementsByClassName("accordionMobile");
    var accNum = acc.length;
    var i;

    //calculating how many MegaMenu we have
    for(i=0; i<accNum; i++){
        acc[i].addEventListener("click", function(){
          this.classList.toggle("active");
          var panel = this.nextElementSibling;

          //adding sub-categories into each MegaMenu button click
            if(panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight+ "px"
            }
        })
     }
  }

  render() {
    return (
      <div className='accordionMenuDivMobile'>
      <div className='accordionMenuDivInsideMobile'>

        {/* Mega btn 1 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 1 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 2 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 3 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 4 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 5 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 6 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 7 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 8 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 9 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 10 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

        {/* Mega btn 11 */}
        <button className='accordionMobile'>
          <img className='accordionMenuIconMobile' src='https://cdn-icons-png.flaticon.com/128/685/685681.png'/>&nbsp; Man's Clothing
        </button>
        <div className='panelMobile'>
          <ul>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 1</a></li>
            <li><a href='#' className='accordionItemMobile'>Man's Tshirt 2</a></li>
          </ul>
        </div>

      </div>

    </div>
    )
  }
}

export default MegaMenuMobile