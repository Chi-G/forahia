import React, { Component, Fragment } from 'react'
import { Col, Button, Container, Row } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import Apple from '../../assets/images/apple.png'
import Google from '../../assets/images/google.png'
import { ToastContainer, toast } from 'react-toastify';
import ReactHtmlParser from 'react-html-parser';
import axios from 'axios';
import AppURL from '../../api/AppURL';

class FooterDesktop extends Component {

  constructor(){
    super();
    this.state = {
      address: "",
      android_app_link: "",
      ios_app_link: "",
      facebook_link: "",
      twitter_link: "",
      instagram_link:"",
      copyright_text:"",
      loaderDiv: "",
      mainDiv: "d-none"
    }
  }

  componentDidMount(){
    // saving data on first load on the local session
    let SiteInfoPurchase = sessionStorage.getItem("AllSiteInfo");

    if(SiteInfoPurchase == null){
      axios.get(AppURL.AllSiteInfo).then(response =>{
        let StatusCode = response.status;

        if(StatusCode === 200){
          let JsonData = (response.data)[0];
          this.setState({
            address:JsonData['address'], 
            android_app_link:JsonData['android_app_link'], 
            ios_app_link:JsonData['ios_app_link'], 
            facebook_link:JsonData['facebook_link'],
            twitter_link:JsonData['twitter_link'], 
            instagram_link:JsonData['instagram_link'], 
            copyright_text:JsonData['copyright_text'], 
            loaderDiv:"d-none", 
            mainDiv:""
          });

          sessionStorage.setItem("SiteInfoPurchase", JsonData)
        }
        else {
          toast.error("Something went wrong", {
            theme: "colored",
            position: "bottom-center"
          });
        }
      }).catch(error =>{
        toast.error("Something went wrong", {
          theme: "colored",
          position: "bottom-center"
        });
      });
    }

    else{
      this.setState({about:SiteInfoPurchase});
    }
  }


  render() {
    return (
      <Fragment>
        <div className='footerback m-0 mt-5 pt-3 shadow-sm'>
          <Container>
            <Row className='px-0 my-5'>
              <Col className='p-2' lg={3} md={3} sm={6} xs={12}>

              <div className={this.state.loaderDiv} >
                <div class="ph-item">
                  <div class="ph-col-12">
                    <div class="ph-row">
                      <div class="ph-col-2 big"></div>
                      <div class="ph-col-4"></div>
                      <div class="ph-col-8 empty"></div>
                      <div class="ph-col-6"></div>
                      <div class="ph-col-6 empty"></div>
                      <div class="ph-col-12"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div className={this.state.mainDiv}>
                <h5 className='footer-menu-title'>ADDRESS</h5>

                { ReactHtmlParser(this.state.address) }

              </div>

                <h5 className='footer-menu-title'>SOCIAL LINK</h5>
                <a href={this.state.facebook_link} target='_blank' rel='noreferrer'> <i className='fab m-1 h4 fa-facebook'></i> </a>
                <a href={this.state.instagram_link} target='_blank' rel='noreferrer'> <i className='fab m-1 h4 fa-instagram'></i> </a>
                <a href={this.state.twitter_link} target='_blank' rel='noreferrer'> <i className='fab m-1 h4 fa-twitter'></i> </a>
              </Col>

              <Col className='p-2' lg={3} md={3} sm={6} xs={12}>
                <h5 className='footer-menu-title'>COMPANY</h5>
                <Link to="/about" className='footer-link'>About Us</Link><br></br>
                <Link to="/" className='footer-link'>Profile</Link><br></br>
                <Link to="/contact" className='footer-link'>Contact Us</Link><br></br>
              </Col>

              <Col className='p-2' lg={3} md={3} sm={6} xs={12}>
                <h5 className='footer-menu-title'>MORE INFO</h5>
                <Link to="/purchase" className='footer-link'>How to Purchase</Link><br></br>
                <Link to="/privacy" className='footer-link'>Privacy Policy</Link><br></br>
                <Link to="/refund" className='footer-link'>Refund Policy</Link><br></br>
              </Col>

              <Col className='p-2' lg={3} md={3} sm={6} xs={12}>
                <h5 className='footer-menu-title'>DOWNLOAD APP</h5>
                <a href={this.state.android_app_link} target='_blank' rel='noreferrer'> <img src={Google} /> </a> <br></br>
                <a href={this.state.ios_app_link} target='_blank' rel='noreferrer'> <img className='mt-2' src={Apple} /> </a> <br></br><br></br>

                {/* Change Language button */}
                {/* Change Language */}
                {/* <div  id='google_translate_element'>
                </div> */}

              </Col>
            </Row>
          </Container>

          <Container fluid={true} className='text-center m-0 pt-3 pb-1 bg-dark'>
            <Container>
              <Row>
                <h6 className='text-white'> { ReactHtmlParser(this.state.copyright_text) } </h6>
              </Row>
            </Container>
          </Container>
      <ToastContainer />
        </div>
      </Fragment>
    )
  }
}

export default FooterDesktop