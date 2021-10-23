import React, { useEffect, useReducer } from 'react';
import ReactDOM from 'react-dom';
import ProfileApis from '../../apis/ProfileApis';
import StudentChart from './StudentChart';
import Sidebar from './Sidebar';

const Dashboard = ({ user }) => {
    const [state, setState] = useReducer((state, newState) => ({ ...state, ...newState }),
        {
            user: user,
            batch_enrolement: []
        });

    useEffect(() => {
        getProfileData();
    }, [])

    const getProfileData = async () => {
        const res = await ProfileApis.profile(user.id);
        console.log(res);
        if (res.success) {
            setState({
                batch_enrolement: res.data.batchStudentEnrollment
            })
        }
    }

    // console.log(course_enrolement, batch_enrolement, user);
    // let enroledCourses = <div class="single-course">
    //     <a href="#" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
    //         <span class="overlay__content"></span>
    //     </a>
    //     <div class="flex">
    //         <a class="card-title mb-4pt" href="#">No Enrolled Courses</a>
    //     </div>
    // </div>;
    // if (course_enrolement.length > 0) {
    //     enroledCourses = course_enrolement.map(cenrolement => {
    //         const courseUrl = "/course/course-preview/" + cenrolement.course.slug;
    //         return <div className="single-course">
    //             <a href={courseUrl} className="avatar avatar-4by3 mr-12pt">
    //                 {cenrolement.course.logo ?
    //                     <img src={"/storage/" + cenrolement.course.logo} class="avatar-img rounded" alt="course" />
    //                     :
    //                     <img src="/student/public/images/paths/mailchimp_430x168.png" class="avatar-img rounded" alt="course" />
    //                 }
    //                 <span class="overlay__content"></span>
    //             </a>
    //             <div class="flex">
    //                 <a class="card-title mb-4pt" href={courseUrl}>{cenrolement.course.title}</a>
    //             </div>
    //         </div>
    //     })
    // }

    const { batch_enrolement } = state;

    if (batch_enrolement?.length == 0) return <div className="w-100 h-100 p-5 text-center text-md">Loading...</div>;

    let enroledBatches = <div class="single-course">
        <a href="#" class="avatar avatar-4by3 mr-12pt">
            <span class="overlay__content"></span>
        </a>
        <div class="flex">
            <a class="card-title mb-4pt" href="#">No batches</a>
        </div>
    </div>;

    if (batch_enrolement.length > 0) {
        enroledBatches = batch_enrolement.map(benrolement => {
            const bcourseUrl = "/batch/" + benrolement.batch.slug;
            return <div class="single-course bshadow bradius-15 mb-4 p-4">
                <a href={bcourseUrl} class="avatar avatar-4by3 mr-12pt">
                    <div className="row">
                        <div className="col-lg-4">
                            {benrolement.course.logo ?
                                <img src={"/storage/" + benrolement.course.logo} class="rounded-circle img-fluid" alt="course" />
                                :
                                <img src="/student/public/images/paths/mailchimp_430x168.png" class=" rounded-circle img-fluid" alt="course" />
                            }
                        </div>
                        <div className="col-lg-8">
                            <h4 className="text-xsm text-black fw-600 mb-2">{benrolement.course.title}</h4>
                            <h5 className="text-xxsm text-black fw-600 mb-3">Batch: {benrolement.batch.title}</h5>
                            <div className="row text-gray text-xxxsm">
                                <div className="col-6 pr-0">
                                    <div className="mb-3">
                                        <i class="fas fa-book-open"></i> 24 Lesson
                                    </div>
                                    <div>
                                        <i class="fas fa-file-alt"></i> 6 Assignments
                                    </div>
                                </div>
                                <div className="col-6 pr-0">
                                    <div className="mb-3">
                                        <i class="far fa-clock"></i> {benrolement.course.duration} Months
                                    </div>
                                    <div>
                                        <i class="fas fa-user-friends"></i> 312 Students
                                    </div>
                                </div>
                            </div>
                            <a href={bcourseUrl} class="btn d-inline-block mt-4 fw-800 text-xxsm btn-outline text-purple px-4">Go to course</a>
                        </div>
                    </div>
                </a>
            </div>
        })
    }

    return <div>
        <Sidebar />
        <div className="dashboard-content">
            <div class="px-lg-5 px-3">
                <div class="row">
                    <div class="col-md-5">
                        <div className="">
                            <div class="student-info pt-5 mb-4">
                                <h2 className="text-black text-md">Hello {user.name}</h2>
                                <p className="text-gray text-xxsm">Nice to have you back, what an exciting day! Get ready and continue your lesson today.</p>
                            </div>
                            {/* <div class="page-headline text-left">
                    <h2 className="text-xsm text-gray">Your enrolled courses</h2>
                </div>
                <div className="mb-4">
                {enroledCourses}
                </div> */}

                            <div class="page-headline text-left">
                                <h2 className="text-sm mb-3 text-black fw-600">Enrolled Courses</h2>
                            </div>
                            {enroledBatches}
                        </div>
                    </div>
                    <div class="col-md-7 pl-lg-4">
                        <div className="row pt-5">
                            <div className="col-5">
                                <div className="profile-photo">
                                    <img src={user.image ? "/storage/" + user.image : "/admin/dist/img/avatar.png"} className="w-10 img-thumbnail bshadow bradius-10" alt="" />
                                </div>
                                <h3 className="pt-2 text-sm text-black fw-600 mb-4">{user.name}</h3>
                                <div className="p-3 bshadow text-xxsm text-gray bradius-10 text-left bg-purple-light-50">
                                    <i className="fas fa-book-open"></i><br />
                                    <span className="text-purple fw-600">{batch_enrolement.length}</span> courses
                                </div>
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
                                <div className="row mt-4">
                                    <div className="col-lg-6 mb-lg-0 mb-4">
                                        <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-green">
                                            <div className="d-flex justify-content-between">
                                                <img src="/img/profile/strenth.svg" className="d-block" alt="" />
                                                <a href="#" className="d-block">
                                                    <img src="/img/profile/link.svg" className="d-block" alt="" />
                                                </a>
                                            </div>
                                            <h3 className="text-white text-xsm mt-3 fw-600">Strength</h3>
                                            <p className="text-white text-xxsm mb-0">ক্ষমতা,কাজ,ভেক্টর</p>
                                        </div>
                                    </div>
                                    <div className="col-lg-6">
                                        <div className="p-3 bshadow text-xxsm text-gray bradius-10 bg-red">
                                            <div className="d-flex justify-content-between">
                                                <img src="/img/profile/weekness.svg" className="d-block" alt="" />
                                                <a href="#" className="d-block">
                                                    <img src="/img/profile/link.svg" className="d-block" alt="" />
                                                </a>
                                            </div>
                                            <h3 className="text-white text-xsm mt-3 fw-600">Weekness</h3>
                                            <p className="text-white text-xxsm mb-0">ক্ষমতা,কাজ,ভেক্টর</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div className=" mt-5">
                            <h3 className="text-sm text-black fw-600 mb-3">Progress curve</h3>
                            <StudentChart />
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