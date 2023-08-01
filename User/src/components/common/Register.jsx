import React, { Component, Fragment } from 'react'
import { Button, Col, Container, Form, Row } from 'react-bootstrap'
import Login from '../../assets/images/login.png'
import { Link, Redirect } from 'react-router-dom'
import axios from 'axios';
import AppURL from '../../api/AppURL';

class Register extends Component {

  constructor(){
    super();
    this.state= {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      message: '',
      loggedIn: false
    }
  }

   //register form submit function
   formSubmit = (e) => {
    e.preventDefault();
    const data = {
      name:this.state.name,
      email:this.state.email,
      password:this.state.password,
      password_confirmation:this.state.password_confirmation
    }

    axios.post(AppURL.UserRegister, data).then(response =>{
      localStorage.setItem('token', response.data.token)
      this.setState({loggedIn:true});
      this.props.setUser(response.data.user);
    }).catch(error =>{

    });
  }


  render() {

    //Redirect to Profile page after login
    if(this.state.loggedIn){
      return <Redirect to={'/profile'} />
    }

    // prevent and protect URL
    if(localStorage.getItem('token')){
      return <Redirect to='/profile' />
    }

    return (
      <Fragment>
        <Container>
          <Row className='p-2'>
            <Col className='shadow-sm bg-white mt-2' md={12} lg={12} sm={12} xs={12}>
            
            <Row className='text-center'>
              <Col className='d-flex justify-content-center' md={6} lg={6} sm={12} sx={12}>
                <Form className='onboardForm' onSubmit={this.formSubmit}>
                  <h4 className='section-title-login'>User Register</h4>
                  <h6 className='section-sub-title'>Fill In Your Registeration Details</h6>
                  <input className='form-control m-2' onChange={(e)=>{this.setState({name:e.target.value})}} type='text' placeholder='Enter Your name' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({email:e.target.value})}} type='email' placeholder='Enter Your email' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({password:e.target.value})}} type='password' placeholder='Enter Your password' />
                  <input className='form-control m-2' onChange={(e)=>{this.setState({password_confirmation:e.target.value})}} type='password' placeholder='Confirm Your password' />
                  <Button type='submit' className='btn btn-plock m-2 site-btn-login'>Sign Up</Button>
                  <br></br> <br></br>
                  <hr />
                  <p> <b>Forget Password? </b>
                    <Link to='/forget' >
                      <b>Forget Password </b>
                    </Link> 
                  </p>

                  <p> <b>Already have an Account? </b>
                    <Link to='/login'>
                      <b>Login </b>
                    </Link> 
                  </p>
                </Form>
              </Col>

              <Col className='p-2 Desktop m-0' md={6} lg={6} sm={6} sx={6}>
                <img className='onboardBanner' src={Login} />
              </Col>  
            </Row>
            
            
            </Col>
          </Row>
        </Container>
      </Fragment>
    )
  }
}

export default Register