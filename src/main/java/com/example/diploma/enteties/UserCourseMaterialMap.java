package com.example.diploma.enteties;

import jakarta.persistence.Column;
import jakarta.persistence.EmbeddedId;
import jakarta.persistence.Entity;
import jakarta.persistence.Table;

@Entity(name = "userMaterial")
@Table(name = "user_material")
public class UserCourseMaterialMap {

    @EmbeddedId
    private UserCourseMaterialPK pk;
    @Column(name = "status")
    private Boolean status;

    public UserCourseMaterialMap() {
    }

    public UserCourseMaterialMap(UserCourseMaterialPK pk, Boolean status) {
        this.pk = pk;
        this.status = status;
    }

    public UserCourseMaterialPK getPk() {
        return pk;
    }

    public void setPk(UserCourseMaterialPK pk) {
        this.pk = pk;
    }

    public Boolean getStatus() {
        return status;
    }

    public void setStatus(Boolean status) {
        this.status = status;
    }
}