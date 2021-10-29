import React, { useEffect, useReducer } from 'react';
import ReactDOM from 'react-dom';
import ProfileApis from '../../apis/ProfileApis';
import StudentChart from './StudentChart';
import Sidebar from './Sidebar';
import CourseCard from '../course/CourseCard';
import Analysis from './Analysis';

const Dashboard = ({ user }) => {
    const [state, setState] = useReducer((state, newState) => ({ ...state, ...newState }),
        {
            user: user,
            batch_enrolement: null,
            related_courses: [],
            results: null,
            active_batch: null,
            tag_reports: null,
            chart: false
        });

    useEffect(() => {
        getProfileData();
    }, []);

    useEffect(() => {
        if (state.active_batch) {
            
            state.chart = '';
            getBatchResults();
        }
    }, [state.active_batch])

    const getProfileData = async () => {
        const res = await ProfileApis.profile();
        if (res.success) {
            setState({
                batch_enrolement: res.data.batchStudentEnrollment,
                related_courses: res.data.related_courses,
                // results: res.data.results,
                active_batch: res.data.batchStudentEnrollment[0]
            });
        }
    }

    const getBatchResults = async () => {
        // setState({results :{labels: ["Exam"], mcq: [0], cq: [0]}});

        const res = await ProfileApis.batchResults({ active_batch_id: state.active_batch.batch_id });
        if (res.success) {
            setState({
                // batch_enrolement: res.data.batchStudentEnrollment,
                // related_courses: res.data.related_courses,
                results: res.data.batch_results,
                tag_reports: res.data.tag_reports
                // active_batch: res.data.batchStudentEnrollment[0]
            })
        }
    }

    const changeActiveBatch = (batch) => {
        setState({
            active_batch: batch
        });
    }

    const { batch_enrolement, related_courses, results, tag_reports, active_batch } = state;

    if (!batch_enrolement) return <div className="w-100 h-100 p-5 text-center text-md"><img height="100px" src="/img/landing/loading.gif" alt="" /></div>;

    let enroledBatches = <div className="single-course">
        <a href="#" className="avatar avatar-4by3 mr-12pt">
            <span className="overlay__content"></span>
        </a>
        <div className="flex">
            <a className="card-title mb-4pt" href="#">No batches</a>
        </div>
    </div>;

    if (batch_enrolement?.length > 0) {
        enroledBatches = batch_enrolement.map(benrolement => {
            return <CourseCard key={"bt_en_" + benrolement.id} changeActiveBatch={changeActiveBatch} data={state} benrolement={benrolement} goCourse={true} />
        })
    }

    let relatedCourses = '';
    if (related_courses.length > 0) {
        relatedCourses = related_courses.map(renrolement => {
            return <CourseCard key={"bt_en_" + renrolement.id} data={state} benrolement={renrolement} goCourse={false} />
        })
    }
    // console.log(results);
    
    if (results?.mcq.length > 0 || results?.mcq.length > 0) state.chart = <StudentChart results={results} />;

    return <div>
        <Sidebar />
        <div className="dashboard-content">
            <div className="px-lg-5 px-3">
                <div className="row">
                    <div className="col-md-5">
                        <div className="">
                            <div className="student-info pt-5 mb-4">
                                <h2 className="text-black text-md">Hello {user.name}</h2>
                                <p className="text-gray text-xxsm">Nice to have you back, what an exciting day! Get ready and continue your lesson today.</p>
                            </div>

                            {batch_enrolement?.length > 0 && <><div className="page-headline text-left">
                                <h2 className="text-sm mb-3 text-black fw-600">Enrolled Courses</h2>
                            </div>
                            {enroledBatches}</>}
                            <div className="page-headline text-left">
                                <h2 className="text-sm mb-3 text-black fw-600">Related Courses</h2>
                            </div>
                            {relatedCourses}
                            <a href="/course" className="btn d-inline-block mt-4 fw-800 text-xxsm text-white bg-purple mb-3 px-4">View all courses</a>
                        </div>
                    </div>
                    <div className="col-md-7 pl-lg-4">
                        <div className="row pt-5">
                            <div className="col-5">
                                <div className="profile-photo">
                                    <img src={user.image ? "/storage/" + user.image : "/img/landing/student.png"} className="w-10 img-thumbnail bshadow bradius-10" alt="" />
                                </div>
                                <h3 className="pt-2 text-sm text-black fw-600 mb-4">{user.name}</h3>
                                {/* <div className="p-3 bshadow text-xxsm text-gray bradius-10 text-left bg-purple-light-50">
                                    <i className="fas fa-book-open"></i><br />
                                    <span className="text-purple fw-600">{batch_enrolement.length}</span> courses
                                </div> */}
                            </div>
                            <div className="col-7">
                                <div className="p-3 bshadow text-xxsm text-gray bradius-10 d-flex justify-content-between">
                                    <div className="p-3 bshadow text-xxsm text-gray bradius-10 w-auto d-inline-block">
                                        <img src="/img/profile/badge_rank.svg" alt="" />
                                    </div>
                                    <div>
                                        <h4 className="text-purple text-sm text-right">Rank</h4>
                                        <h4 className="text-purple text-md fw-600"># 12th</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {tag_reports ? <Analysis {...tag_reports} course={active_batch.course} /> : ""}
                        <div className=" mt-5">
                            <h3 className="text-sm text-black fw-600 mb-3">Progress curve</h3>
                            {state.chart}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>;
}

export default Dashboard;

if (document.getElementById('studentDashboard')) {
    const el = document.getElementById('studentDashboard');
    // const course_enrolement = el.getAttribute('data-course-enrolement') ? JSON.parse(el.getAttribute('data-course-enrolement')) : [];
    // const batch_enrolement = el.getAttribute('data-batch-enrolement') ? JSON.parse(el.getAttribute('data-batch-enrolement')) : [];
    const user = el.getAttribute('data-user') ? JSON.parse(el.getAttribute('data-user')) : [];
    ReactDOM.render(<Dashboard
        // course_enrolement={course_enrolement} batch_enrolement={batch_enrolement} 
        user={user} />, el);
}