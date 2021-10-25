const ProfileApis = {};

ProfileApis.profile = async( params=null) => {
    let url = "/profile-data";
    const res = await axios.get(url, {params: params})
        .then(response=> {
            return response.data;
        }).catch(error=>{ return []; });
    return res;
}

ProfileApis.batchResults = async( params=null) => {
    let url = "/batch-results"
    const res = await axios.get(url, {params: params})
        .then(response=> {
            return response.data;
        }).catch(error=>{ return []; });
    return res;
}

export default ProfileApis;