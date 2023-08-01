import React, { Component, Fragment } from 'react'
import { Button, Col, Container, Form, Row } from 'react-bootstrap'
import validation from '../../validation/validation';
import axios from 'axios';
import AppURL from '../../api/AppURL';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import Breadcrumb from 'react-bootstrap/Breadcrumb';
import { Link } from 'react-router-dom';

class Contact extends Component {

  constructor(){
    super();
    this.state={
      name:"",
      email:"",
      message:""
    }
  }

  nameOnChange = (event)=> {
    let name = event.target.value;
    // alert(name);
    this.setState({name:name})
  }

  emailOnChange = (event)=> {
    let email = event.target.value;
    // alert(email);
    this.setState({email:email})
  }

  messageOnChange = (event)=> {
    let message = event.target.value;
    // alert(message);
    this.setState({message:message})
  }

  onFormSubmit = (event)=> {
    let name = this.state.name;
    let email = this.state.email;
    let message = this.state.message;
    let sendBtn = document.getElementById('sendBtn');
    let contactForm = document.getElementById('contactForm');

    if(name.length === 0){
      toast.error("name field is required, fill the form", {
        theme: "colored",
      });
    }
    else if(email.length === 0){
      toast.error("email field is required, input a valid email", {
        theme: "colored",
      });
    }
    else if(message.length === 0){
      toast.error("message field is required, write a message", {
        theme: "colored",
      });
    }
    else if(!(validation.NameRegx).test(name)){
      toast.error("Input a valid name", {
        theme: "colored",
      });
    }
    else {

      sendBtn.innerHTML = "Sending...";

      let MyFormData = new FormData();
      MyFormData.append("name", name)
      MyFormData.append("email", email)
      MyFormData.append("message", message)

      axios.post(AppURL.PostContact, MyFormData)
      .then(function (response) {
        if(response.status === 200 && response.data === 1){
          toast.success("Message Sent Successfully", {
            theme: "colored",
          });
          sendBtn.innerHTML = "Submit";
          contactForm.reset();
        } 
        else{
          toast.error("error", {
            theme: "colored",
          });
          sendBtn.innerHTML = "Submit";
        }
      })
      .catch(function (error){
        toast.error(error, {
          theme: "colored",
        });
        sendBtn.innerHTML = "Submit";
      });
    }
    event.preventDefault();
  }


  render() {
    return (
      <Fragment>
        <Container>

        <div className='breadbody'>
          <Breadcrumb>
            <Breadcrumb.Item> <Link to='/'> Home </Link> </Breadcrumb.Item>
            <Breadcrumb.Item> <Link to='/contact'> Contact </Link> </Breadcrumb.Item>
          </Breadcrumb>
        </div>

          <Row className='p-2'>
            <Col className='shadow-sm bg-white mt-2' md={12} lg={12} sm={12} xs={12}>
            
            <Row className='text-center'>
              <Col className='d-flex justify-content-center' md={6} lg={6} sm={12} sx={12}>
                <Form id='contactForm' onSubmit={this.onFormSubmit} className='onboardForm'>
                  <h4 className='section-title-login'>Contact With Us</h4>
                  <h6 className='section-sub-title'>Please Contact with Us</h6>
                  <input onChange={this.nameOnChange} className='form-control m-2' type='text' placeholder='Enter Your Name' />
                  <input onChange={this.emailOnChange} className='form-control m-2' type='email' placeholder='Enter Email' />
                  <Form.Control onChange={this.messageOnChange} className='form-control m-2' as='textarea' rows={3} placeholder='Enter Your Message' />
                  <Button id='sendBtn' type='submit' className='btn btn-plock m-2 site-btn-login'>Submit</Button>
                </Form>
              </Col>

              <Col className='p-2 Desktop m-0' md={6} lg={6} sm={6} sx={6}><br></br><br></br>
                <p className='section-title-contact'>D5 Ehimiri Housing Estate Umuahia, Abia State</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.3355589827515!2d7.519717173531512!3d5.517118294462945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1042dcab1c6d205b%3A0xc8feb16efcb97321!2sEHIMIRI%20HOUSING%20ESTATE!5e0!3m2!1sen!2sng!4v1684099460003!5m2!1sen!2sng" width="500" height="450" styleS="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

export default Contact