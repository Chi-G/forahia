import React, { Component, Fragment } from 'react'
import { Col, Container, Row } from 'react-bootstrap'
import axios from 'axios';
import AppURL from '../../api/AppURL';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import ReactHtmlParser from 'react-html-parser';
import Breadcrumb from 'react-bootstrap/Breadcrumb';
import { Link } from 'react-router-dom';

class Refund extends Component {

  constructor(){
    super();
    this.state = {
      refund: "",
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
          let JsonData = (response.data)[0]['refund'];
          this.setState({refund:JsonData, loaderDiv:"d-none", mainDiv:""});

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
      this.setState({refund:SiteInfoPurchase});
    }
  }



  render() {
    return (
      <Fragment>
        <Container>

        <div className='breadbody'>
          <Breadcrumb>
            <Breadcrumb.Item> <Link to='/'> Home </Link> </Breadcrumb.Item>
            <Breadcrumb.Item> <Link to='/refund'> Refund </Link> </Breadcrumb.Item>
          </Breadcrumb>
        </div>

          <Row className='p-2'>
            <Col className='shadow-sm bg-white mt-2' md={12} lg={12} sm={12} xs={12}>

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
                  <div class="ph-col-12"></div>
                  <div class="ph-col-12"></div>
                </div>
              </div>
            </div>
          </div>

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
                  <div class="ph-col-12"></div>
                  <div class="ph-col-12"></div>
                </div>
              </div>
            </div>
          </div>

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
                  <div class="ph-col-12"></div>
                  <div class="ph-col-12"></div>
                </div>
              </div>
            </div>
          </div>

          <div className={this.state.mainDiv}>
              <h4 className='section-title-login'> Refund Page </h4>           
              <p className='section-title-contact'>
              { ReactHtmlParser(this.state.refund) }
              </p>
          </div>
            
            </Col>
          </Row>
        </Container>
        <ToastContainer />
      </Fragment>
    )
  }
}

export default Refund