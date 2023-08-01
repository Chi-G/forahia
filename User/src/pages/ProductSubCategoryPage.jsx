import React, { Component, Fragment } from 'react'
import NavMenuDesktop from '../components/common/NavMenuDesktop';
import NavMenuMobile from '../components/common/NavMenuMobile';
import FooterDesktop from '../components/common/FooterDesktop';
import FooterMobile from '../components/common/FooterMobile';
import axios from 'axios';
import AppURL from '../api/AppURL';
import SubCategory from '../components/ProductDetails/SubCategory';


class ProductSubCategoryPage extends Component {

   //getting the Categories from the home page on a click
   constructor({match}){
    super();
    this.state = {
      Category:match.params.category,
      SubCategory:match.params.subcategory,
      ProductData:[]
    }
  }

  componentDidMount(){
    window.scroll(0,0)
      axios.get(AppURL.ProductListBySubcategory(this.state.Category, this.state.SubCategory)).then(response =>{
        this.setState({ProductData:response.data});
      }).catch(error =>{
        
      });
  }


  render() {
    return (
      <Fragment>
        <div className='Desktop'>
          <NavMenuDesktop />          
        </div>

        <div className='Mobile'>
          <NavMenuMobile />
        </div>

        {/* loading and displaying the category, subcategory and product data from the home page with a btn click */}
        <SubCategory Category={this.state.Category} SubCategory={this.state.SubCategory} ProductData={this.state.ProductData} />

        <div className='Desktop'> <FooterDesktop /> </div>
        <div className='Mobile'> <FooterMobile /> </div>
      </Fragment>
    )
  }
}

export default ProductSubCategoryPage