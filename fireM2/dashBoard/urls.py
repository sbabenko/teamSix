from django.urls import path
from dashBoard import views


urlpatterns = [
    path('', views.index, name='index'),
    path('First Responder', views.first_respond_dash_view, name="first_respond_dash_view"),
    path('Operations Chief', views.ops_chief_dash_view, name="ops_chief_dash_view"),
    path('Mission Manager', views.miss_mgmt_dash_view, name="miss_mgmt_dash_view"),
]

