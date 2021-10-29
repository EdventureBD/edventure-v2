import React, { Component, useEffect, useState } from "react";

const StudentChart = (props) => {
    let chart = '';
    let canvas = '';
    let ctx = '';
    const options = {
      type: 'line',
      data: {
        labels: props.results.labels,
        datasets: [{
          label: "MCQ",
          backgroundColor: 'rgba(251, 134, 224, 0.2)',
          borderColor:'#FB86E0',
          data: props.results.mcq
        }, {
          label: "CQ",
          backgroundColor: 'rgba(88, 64, 184, 0.2)',
          borderColor:'#5840B8',
          data: props.results.cq
        }]
      },
      options: {
        scales: {
          xAxes: [{
            display: true,
            beginAtZero: true
          }],
          yAxes: [{
            type: "linear",
            display: true,
            position: "left",
            beginAtZero: true
          }]
        },
        responsive: true
      }
    }
    
    const toggleChart = () => {
      options.type = options.type === 'line' ? 'bar' : 'line';
      chart.destroy()
      chart = new Chart(this.ctx, this.options)
    }
    
    useEffect(()=>{
      canvas = document.querySelector('canvas')
      ctx = canvas.getContext('2d')
      chart = new Chart(ctx, options)
    }, [props.results])
    
      return (
        <div>
          <canvas />
          {/* <div className="text-center">
            <button className="btn btn-primary" onClick={this.toggleChart}>Toggle</button>
          </div> */}
        </div>
      )
  }

  export default StudentChart;