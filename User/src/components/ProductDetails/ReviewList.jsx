import axios from 'axios';
import React, { Component } from 'react'
import AppURL from '../../api/AppURL';

class ReviewList extends Component {

  constructor(){
    super();
    this.state = {
      ReviewData:[],
    }
  }

  componentDidMount(){
    let code = this.props.code;
    axios.get(AppURL.ReviewList(code)).then(response =>{
      this.setState({ReviewData:response.data});
    }).catch(error =>{
      
    });
  }

  render() {

    const MyList = this.state.ReviewData;

    if(MyList.length > 0) {
      const MyView = MyList.map((ReviewList, i) => {

        if(ReviewList.reviewer_rating === "1"){
          return <div>
            <span> {ReviewList.reviewer_name} </span>
            <p className=" p-0 m-0"><span className="Review-Title"> {ReviewList.product_name} </span> <span className="text-success"><i className="fa fa-star"></i> </span> </p>
            <p>{ReviewList.reviewer_comments}</p>
        </div>
        }else if(ReviewList.reviewer_rating === "2"){
          return <div>
          <span> {ReviewList.reviewer_name} </span>
          <p className=" p-0 m-0"><span className="Review-Title"> {ReviewList.product_name} </span> <span className="text-success"><i className="fa fa-star"></i> <i className="fa fa-star"></i></span> </p>
          <p>{ReviewList.reviewer_comments}</p>
        </div>
        }else if(ReviewList.reviewer_rating === "3"){
          return <div>
          <span> {ReviewList.reviewer_name} </span>
          <p className=" p-0 m-0"><span className="Review-Title"> {ReviewList.product_name} </span> <span className="text-success"><i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> </span> </p>
          <p>{ReviewList.reviewer_comments}</p>
        </div>
        }else if(ReviewList.reviewer_rating === "4"){
          return <div>
          <span> {ReviewList.reviewer_name} </span>
          <p className=" p-0 m-0"><span className="Review-Title"> {ReviewList.product_name} </span> <span className="text-success"><i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> </span> </p>
          <p>{ReviewList.reviewer_comments}</p>
        </div>
        } else if(ReviewList.reviewer_rating === "5"){
          return <div>
          <span> {ReviewList.reviewer_name} </span>
          <p className=" p-0 m-0"><span className="Review-Title"> {ReviewList.product_name} </span> <span className="text-success"><i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i> </span> </p>
          <p>{ReviewList.reviewer_comments}</p>
        </div>
        }
        //end else if
        
      }); // end map condition

      return (
        <div>
          <h6 className="mt-2">REVIEWS</h6>
            {MyView}
        </div>
      )

    } else {
      return (
        <div>
          <h6 className="mt-2">REVIEWS</h6>
          <p>This product does not have a review yet</p>
        </div>
      )

    }

    
  }
}

export default ReviewList