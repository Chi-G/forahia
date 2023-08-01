import React, { Component } from 'react'
import AppURL from '../../api/AppURL';
import axios from 'axios'
import { Link } from 'react-router-dom';

class MegaMenuAll extends Component {

   // binding it to the constructor dianamically
   constructor(){
    super();
    this.state = {
      MenuData:[]
    }
  }

  componentDidMount(){
      axios.get(AppURL.AllCategoryDetails).then(response =>{
        this.setState({MenuData:response.data});
      }).catch(error =>{
        
      });
  }

  //menu drop down items function 
  MenuItemClick =(event)=>{
    event.target.classList.toggle("active");
    var panel = event.target.nextElementSibling;
      if(panel.style.maxHeight){
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight+ "px"
      }
  }

  render() {

    const CatList = this.state.MenuData;
    const MyView = CatList.map((CatList, i)=>{
      return <div key={i.toString()}>

        {/* Mega btn's for all Categories */}
        <button onClick={this.MenuItemClick} className='accordionAll'>
              <img className='accordionMenuIconAll' src={CatList.category_image} />&nbsp; {CatList.category_name}
            </button>
            {/* looping through to fetch the sub-category items from db*/}
            <div className='panelAll'>
              <ul>
                {
                  (CatList.subcategory_name).map((SubList, i)=>{
                     return <li>
                              <Link to={"/productsubcategory/"+CatList.category_name+"/"+SubList.subcategory_name} className='accordionItem'>
                                {SubList.subcategory_name}
                              </Link>
                            </li>                      
                  })
                }
              </ul>
            </div>
      </div>
    });


    return (
      <div className='accordionMenuDivAll'>
      <div className='accordionMenuDivInsideAll'>

        {/* calling Mega btn load view */}
          {MyView}
      </div>

    </div>
    )
  }
}

export default MegaMenuAll