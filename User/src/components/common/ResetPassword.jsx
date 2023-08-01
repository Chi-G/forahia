import React, { Component, Fragment } from 'react'
import { Button, Col, Container, Form, Row } from 'react-bootstrap'
import Forget from '../../assets/images/forget.jpg'
import { Link } from 'react-router-dom'
import axios from 'axios';
import AppURL from '../../api/AppURL';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

class ResetPassword extends Component {

  constructor(){
    super();
    this.state= {
      token: '', 
      email: '',
      password: '',
      password_confirmation: '',
      message: ''
    }
  }

  //reset form submit function
  formSubmit = (e) => {
    e.preventDefault();
    const data = {
      token:this.state.token,
      name:this.state.name,
      email:this.state.email,
      password:this.state.password,
      password_confirmation:this.state.password_confirmation
    }

    axios.post(AppURL.UserResetPassword, data).then(response =>{
      this.setState({message:response.data.message})

      toast.success(this.state.message, {
        theme: "colored",
        position: "top-right"
      });
      document.getElementById("formReset").reset();
    }).catch(error =>{
      this.setState({message:error.response.data.message})

      toast.error(this.state.message, {
        theme: "colored",
        position: "top-right"
      });
    });
  }

  render() {
    return (
      <Fragment>
        <Container>
          <Row className='p-2'>
            <Col className='shadow-sm bg-white mt-2' md={12} lg={12} sm={12} xs={12}>
            
            <Row className='text-center'>
              <Col className='d-flex justify-content-center' md={6} lg={6} sm={12} sx={12}>
                <Form id='formReset' className='onboardForm' onSubmit={this.formSubmit}>
                <h4 className='section-title-login'>Reset Password</h4>
                  <input className='form-control m-2' onChange={(e)=>{this.setState({token:e.target.value})}} type='text' placeholder='Enter Your Pin Code' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({email:e.target.value})}} type='email' placeholder='Enter Your email' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({password:e.target.value})}} type='password' placeholder='Enter a new password' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({password_confirmation:e.target.value})}} type='password' placeholder='Confirm Your password' />
                  <Button type='submit' className='btn btn-plock m-2 site-btn-login'>Reset Password</Button>
                </Form>
              </Col>

              <Col className='p-2 Desktop m-0' md={6} lg={6} sm={6} sx={6}>
                <img className='onboardBanner' src={Forget} />
              </Col>  
            </Row>
            
            
            </Col>
          </Row>
        </Container>
        <ToastContainer />
      </Fragment>
    )
  }
}

export default ResetPassword