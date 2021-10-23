const ProfileApis = {};

ProfileApis.profile = async(user_id, params=null) => {
    let url = "/profile/"+user_id;
    const res = await axios.get(url, {params: params})
        .then(response=> {
            return response.data;
        }).catch(error=>{ return []; });
    return res;
}

export default ProfileApis;