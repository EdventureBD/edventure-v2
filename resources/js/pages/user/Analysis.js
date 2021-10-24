import React from 'react';

const Analysis = ({cq, mcq, course}) => {
    return <div className="row mt-4">
        <div className="col-lg-3 mb-lg-0 mb-4">
            <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-green">
                <div className="d-flex justify-content-between">
                    <img src="/img/profile/strenth.svg" className="d-block" alt="" />
                    <a href="#" className="d-block">
                        <img src="/img/profile/link.svg" className="d-block" alt="" />
                    </a>
                </div>
                <h3 className="text-white text-xsm mt-3 fw-600">MCQ Strength</h3>
                <p className="text-white text-xxsm mb-0">{mcq.strength.length > 0 ? mcq.strength.slice(0, 3).map(mcqs=>(mcqs+', ')) : ''}</p>
            </div>
            
        </div>
        <div className="col-lg-3 mb-lg-0 mb-4">
            <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-red">
                <div className="d-flex justify-content-between">
                    <img src="/img/profile/weekness.svg" className="d-block" alt="" />
                    <a href="#" className="d-block">
                        <img src="/img/profile/link.svg" className="d-block" alt="" />
                    </a>
                </div>
                <h3 className="text-white text-xsm mt-3 fw-600">MCQ Weakness</h3>
                <p className="text-white text-xxsm mb-0">{mcq.weakness.length > 0 ? mcq.weakness?.slice(0, 3).map(mcqs=>(mcqs+', ')) : ""}</p>
            </div>
        </div>
        <div className="col-lg-3 mb-lg-0 mb-4">
            <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-green">
                <div className="d-flex justify-content-between">
                    <img src="/img/profile/strenth.svg" className="d-block" alt="" />
                    <a href="#" className="d-block">
                        <img src="/img/profile/link.svg" className="d-block" alt="" />
                    </a>
                </div>
                <h3 className="text-white text-xsm mt-3 fw-600">CQ Strength</h3>
                <p className="text-white text-xxsm mb-0">{cq.strength.length > 0 ? cq.strength?.slice(0, 3).map(mcqs=>(mcqs+', ')) : ""}</p>
            </div>
            
        </div>
        <div className="col-lg-3">
            <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-red">
                <div className="d-flex justify-content-between">
                    <img src="/img/profile/weekness.svg" className="d-block" alt="" />
                    <a href="#" className="d-block">
                        <img src="/img/profile/link.svg" className="d-block" alt="" />
                    </a>
                </div>
                <h3 className="text-white text-xsm mt-3 fw-600">CQ Weakness</h3>
                <p className="text-white text-xxsm mb-0">{cq.weakness.length > 0 ? cq.weakness?.slice(0, 3).map(mcqs=>(mcqs+', ')) : ""}</p>
            </div>
            
        </div>
        <div className="col-lg-6">
            <a href={"/tag-analysis-report/"+course.slug+"?type=mcq"} className="btn d-inline-block mt-4 fw-800 text-xxsm text-white bg-purple mb-3 px-4">All MCQ tag analysis</a>
        </div>
        <div className="col-lg-6">
            <a href={"/tag-analysis-report/"+course.slug+"?type=cq"} className="btn d-inline-block mt-4 fw-800 text-xxsm text-white bg-purple mb-3 px-4">All CQ tag analysis</a>
        </div>
    </div>;
}

export default Analysis;