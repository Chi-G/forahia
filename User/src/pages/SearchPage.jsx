import React, { Component, Fragment } from 'react'
import NavMenuDesktop from '../components/common/NavMenuDesktop';
import NavMenuMobile from '../components/common/NavMenuMobile';
import FooterDesktop from '../components/common/FooterDesktop';
import FooterMobile from '../components/common/FooterMobile';
import axios from 'axios';
import AppURL from '../api/AppURL';
import SearchList from '../components/ProductDetails/SearchList';

class SearchPage extends Component {

   //getting the Categories from the home page on a click
   constructor({match}){
    super();
    this.state = {
      SearchKey:match.params.searchkey,
      ProductData: []
    }
  }

  componentDidMount(){
    window.scroll(0,0)
      axios.get(AppURL.ProductBySearch(this.state.SearchKey)).then(response =>{
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

        {/* loading and displaying the category and product data from the home page with a btn click */}
        <SearchList SearchKey={this.state.SearchKey} ProductData={this.state.ProductData} />

        <div className='Desktop'> <FooterDesktop /> </div>
        <div className='Mobile'> <FooterMobile /> </div>
      </Fragment>
    )
  }
}

export default SearchPage