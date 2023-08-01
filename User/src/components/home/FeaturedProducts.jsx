import axios from 'axios';
import React, { Component, Fragment } from 'react'
import { Container, Row, Col, Card } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import AppURL from '../../api/AppURL';
import 'react-toastify/dist/ReactToastify.css';
import { toast } from 'react-toastify';
import FeatureLoading from '../Placeholder/FeatureLoading';

class FeaturedProducts extends Component {

  constructor(){
    super();
    this.state = {
      ProductData: [],  
      isLoading: "",
      mainDiv: "d-none"
    }
  }

  
  componentDidMount(){    
      axios.get(AppURL.ProductListByRemark("FEATURED")).then(response =>{
        this.setState({ProductData:response.data, isLoading:"d-none", mainDiv:""});
      }).catch(error =>{
        toast.error("Something went wrong", {
          theme: "colored",
          position: "bottom-center"
        });
      });
    }


  render() {

    const FeaturedList = this.state.ProductData;
    const MyView = FeaturedList.map((FeaturedList, i)=>{

      //condition to handle special discount price
      if(FeaturedList.special_price === "na"){
        return <Col className='p-1' key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
                <Link className='text-link' to={"/productdetails/"+FeaturedList.id}>
                <Card className='image-box card'>
                  <img className='center' src={FeaturedList.image} />
                  <Card.Body>
                    <p className='product-name-on-card'>{FeaturedList.title}</p>
                    <p className='product-price-on-card'>Price : ${FeaturedList.price}</p>
                  </Card.Body>
                </Card>
              </Link>
              </Col>
      }else{
        return <Col className='p-1' key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
              <Link className='text-link' to={"/productdetails/"+FeaturedList.id}>
              <Card className='image-box card'>
                <img className='center' src={FeaturedList.image} />
                <Card.Body>
                  <p className='product-name-on-card'>{FeaturedList.title}</p>
                  <p className='product-price-on-card'>Price : <strike className='text-secondary'>${FeaturedList.price}</strike> ${FeaturedList.special_price}</p>

                </Card.Body>
              </Card>
            </Link>
            </Col>
      }
    });

    return (
      <Fragment>
        <FeatureLoading isLoading={this.state.isLoading} />
          <div className={this.state.mainDiv}>
            <Container className='text-center' fluid={true}>
              <div className='section-title text-center mb-55'>
                  <h2> FEATURED PRODUCT </h2>
                  <p>Some Of our Exclusive Feature Products, You May Love</p>
              </div>
              <Row>
              {/* Calling the loopped Rows from db */}
                {MyView}      
              </Row>
          </Container>
        </div>
      </Fragment>
    )
  }
}

export default FeaturedProducts